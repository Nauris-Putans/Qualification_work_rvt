<?php

namespace App\Http\Controllers\Adminlte;

use App\Http\Controllers\Controller;
use Becker\Zabbix\ZabbixApi;
use Becker\Zabbix\ZabbixException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZabbixController extends Controller
{
    /**
     * The ZabbixApi instance.
     *
     * @var ZabbixApi
     */
    protected $zabbix;

    /**
     * Create a new Zabbix API instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->zabbix = app('zabbix');
    }

    private function getUniqueItemIds($allItems){
        $itemsGrouped = [];
        $i=0;

        //Save only unique item ids
        foreach($allItems as $key=>$value) {

            $itemExists = 0;

            //Check if current item was added to '$itemsGrouped' array
            foreach($itemsGrouped as $groupedValue) {
                $newItem = $value;
                if($newItem == $groupedValue){
                    $itemExists = 1;
                    break;
                }
            }

            //Save item id if in was unique
            if($itemExists == 0){
                $itemsGrouped[$i] = $value;
                $i++;
            }
        }

        return $itemsGrouped;
    }

    private function getItemsHystoryFromZabbix($items){

        date_default_timezone_set("Europe/Riga");
        $date  = mktime(date("H")-1, date("i"), date("s"), date("m"), date("d"), date("Y"));

        $histories = $this->zabbix->historyGet([
            'output' => 'extend',
            'history' => '0',
            'time_from' => $date,
            'sortorder' => 'DESC',
            'itemids' => $items ,
        ]);

        $itemsWithHistory = [];
        $k = 0;
        foreach($items as $itemId) {
            $itemsWithHistory[$k] = (object)[
                'itemId' => $itemId,
                'history' => []
            ];

            for($i=0; $i < sizeof($histories); $i++) {
                if($itemId == $histories[$i]->itemid){
                    array_push($itemsWithHistory[$k]->history, $histories[$i]);
                }
            }
            $k++;
        }

        return $itemsWithHistory;
    }

    private function getLastChecksHystory($userId,$userGroup){
        
        $currentStatus = [
            'values' => [
                'up' => 0,
                'down' => 0
            ],
            'percentage' => [
                'up' => 0,
                'down' => 0,
                'paused' => 0
            ]
        ];  

        date_default_timezone_set("Europe/Riga");
        $yesterday  = mktime(date("H")-1, date("i"), date("s"), date("m"), date("d"), date("Y"));

        //Get current user ID;
        $currentUserID = $userId;

        //Get paused monitors
        $disabledMonitors = DB::table('monitoring_monitors')
            ->where('user_group', $userGroup)
            ->where('status', 2)
            ->get('host');

        $currentStatus['values']['paused'] = $disabledMonitors->count();

        $enabledMonitors = DB::table('monitoring_monitors')
            ->join('monitoring_hosts', 'monitoring_hosts.host_id', '=', 'monitoring_monitors.host')
            ->join('host_has_application_webscenario', 'host_has_application_webscenario.host_id', '=', 'monitoring_hosts.host_id')
            ->join('monitoring_items', 'monitoring_items.application', '=', 'host_has_application_webscenario.application')
            ->where('user_group', $userGroup)
            ->where('status', 1)
            ->where('check_type', 2)
            ->get(['item_id as item','monitor_type']);
    

        $activeMonitors = array();
        $itemsIds = array();

        $i = 0;
        foreach($enabledMonitors as $key=>$value) {
            $itemsIds[$i] = $value->item;
            $i++;
        }

        $histories = $this->zabbix->historyGet([
            'output' => 'extend',
            'time_from' => $yesterday,
            "sortfield" => "clock",
            'sortorder' => 'DESC',
            'itemids' => $itemsIds,
        ]);

        foreach($enabledMonitors as $key=>$value) {
            foreach($histories as $hKey=>$hValue) {
                if($hValue->itemid == $value->item){
                    $activeMonitors[$key] = $hValue;
                    break;
                }
            }
        }
        
        foreach($enabledMonitors as $key=>$value) {
            foreach($activeMonitors as $activeKey=>$activeValue) {
                if($value->item == $activeValue->itemid){
                    if($value->monitor_type != 1){
                        if($activeValue->value == 0){
                            $activeMonitors[$activeKey]->value = 1;
                        }else{
                            $activeMonitors[$activeKey]->value = 0;
                        }
                    }
                }
            }
        }
        
        $upMonitors = 0;
        $downMonitors = 0;

        foreach ($activeMonitors as $key=>$value) {

            if($value->value == 200 || $value->value == 1){
                $upMonitors+=1;
            }else{
                $downMonitors+=1;
            }
        }

        $currentStatus['values']['up'] = $upMonitors;
        $currentStatus['values']['down'] = $downMonitors;

        $allMonitorCount = $upMonitors + $downMonitors + $disabledMonitors->count();

        if($allMonitorCount != 0){
            $currentStatus['percentage']['up'] = $upMonitors * 100 / $allMonitorCount;
            $currentStatus['percentage']['down'] = $downMonitors * 100 / $allMonitorCount;
            $currentStatus['percentage']['paused'] = $disabledMonitors->count() * 100 / $allMonitorCount;
        }
        
        return compact(['currentStatus']);
    }

    public function getGroupMembersElements($currentUserID, $userGroup){

        $groupMembers = DB::table('monitoring_group_members')
            ->join('users', 'users.id', '=', 'monitoring_group_members.group_member')
            ->where('group_id', $userGroup)
            ->get(['id as userID', 'name', 'email_verified_at', 'gender', 'profile_image']);

        $elementGroupMembers = DB::table('dashboard_element')
            ->where('user', $currentUserID)
            ->where('group', $userGroup)
            ->where('itemType', 3)
            ->get(['elementId as uniqIdForItem','element_position', 'container']);

        $elements = [];
        foreach($elementGroupMembers as $key=>$properties){
            $elements[$key] = (object)[];
            $elements[$key] = $properties;
            $elements[$key]->members = (object)[];

            $elements[$key]->members = $groupMembers;

        }

        return $elements;
    }

    public function index(Request $request)
    {

        //Get current user ID;
        $currentUserID = $request->session()
            ->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");
 
        //Get user Group ID
        $userGroup = $request->session()->get('groupId');

        $groupHosts = DB::table('monitoring_monitors')
            ->where('user_group', $userGroup)
            ->get(['host','friendly_name']);

        $allItems = DB::table('monitoring_monitors')
            ->join('monitoring_hosts', 'monitoring_hosts.host_id', '=', 'monitoring_monitors.host')
            ->join('host_has_application_webscenario', 'host_has_application_webscenario.host_id', '=', 'monitoring_hosts.host_id')
            ->join('monitoring_items', 'monitoring_items.application', '=', 'host_has_application_webscenario.application')
            ->join('monitoring_check_types', 'monitoring_check_types.id', '=', 'monitoring_items.check_type')
            ->where('user_group', $userGroup)
            ->get(['item_id','friendly_name','check_type_name', 'host']);

        $DashboardItemsCurrentCheckStatus = DB::table('dashboard_element')
            ->where('user', $currentUserID)
            ->where('group', $userGroup)
            ->where('itemType', 1)
            ->get(['elementId','element_position', 'container']);

        $currentStatusItemsInfo = [];
        foreach ($DashboardItemsCurrentCheckStatus as $key=>$value){
            $someValue = $this->getLastChecksHystory($currentUserID, $userGroup);
            $currentStatusItemsInfo[$key]=(object)[];
            $currentStatusItemsInfo[$key]->currentStatus = $someValue['currentStatus'];
            $currentStatusItemsInfo[$key]->id = $value->elementId;
            $currentStatusItemsInfo[$key]->element_position = $value->element_position;
            $currentStatusItemsInfo[$key]->container = $value->container;
        }

        $chartElements = DB::table('dashboard_element')
            ->where('user', $currentUserID)
            ->where('group', $userGroup)
            ->where('itemType', 2)
            ->get(['elementId','element_position', 'container', 'name']);

        $items = [];
        foreach($chartElements as $key=>$value) {
            $elementId = $value->elementId;

            $chartElements[$key]->items =  DB::table('dashboard_element_item')
                ->join('monitoring_items', 'item_id', '=', 'item')
                ->join('monitoring_check_types', 'id', '=', 'check_type')
                ->join('measurement_unit', 'unit', '=', 'unit_id')
                ->where('dashboardElement', $elementId)
                ->get(['item', 'chart_type', 'check_type_name as itemType', 'symbol', 'check_type']);

            $chartColors = DB::table('dashboard_element_style')
                ->where('element', $elementId)
                ->get(['item', 'background_color as background', 'border_color as border', 'hover_background_color as hoverBackground', 'border_width']);

            $chartItems = $chartElements[$key]->items;
            foreach($chartItems as $itemKey=>$item) {
                array_push($items, $item->item);
                foreach($chartColors as $color){
                    if($color->item == $item->item){
                        $chartElements[$key]->color[$itemKey] = (object)[];
                        $chartElements[$key]->color[$itemKey]->background = $color->background;
                        $chartElements[$key]->color[$itemKey]->border = $color->border;
                        $chartElements[$key]->color[$itemKey]->hoverBackground = $color->hoverBackground;
                        $chartElements[$key]->color[$itemKey]->borderWidth = $color->border_width;
                    }
                }
            }  
        }

        $allDashboardItems = [];

        $items = $this->getUniqueItemIds($items);
        $itemsWithHistory = $this->getItemsHystoryFromZabbix($items);

        foreach($chartElements as $key=>$value){
            
            foreach($value->items as $itemKey=>$itemValue){

                $itemId = $itemValue->item;
                foreach($itemsWithHistory as $itemHistory){
                    if($itemHistory->itemId == $itemId){
                        $chartElements[$key]->items[$itemKey]->history = $itemHistory->history;
                        break;
                    }
                }
            }
        }

        $itemCounter = 0;

        foreach($chartElements as $value){
            $allDashboardItems[$itemCounter]=$value;
            $allDashboardItems[$itemCounter]->type= 'chart';
            $itemCounter++;
        }

        foreach($currentStatusItemsInfo as $value){
            $allDashboardItems[$itemCounter]=$value;
            $allDashboardItems[$itemCounter]->type= 'currentStatus';
            $itemCounter++;
        }

        $groupMembersElement = $this->getGroupMembersElements($currentUserID, $userGroup);

        foreach($groupMembersElement as $value){
            $allDashboardItems[$itemCounter]=$value;
            $allDashboardItems[$itemCounter]->type= 'groupMemberList';
            $itemCounter++;
        }

        $dashboardItems = $this->setElementsPositionOnDashboard($allDashboardItems);

        $allDashboardItems = $dashboardItems->dashboardItems;
        $lastElementPosition = $dashboardItems->lastElementPosition;

        return view('adminlte/user_admin/index',compact(['groupHosts', 'allItems','allDashboardItems','lastElementPosition']));
    }

    function setElementsPositionOnDashboard($dashboardItems){
        $lastElementPosition = 0;
        for($i=0; $i<count($dashboardItems);$i++){
            $currentCheckElement = $dashboardItems[0];
            $currentCheckElementPosition = $dashboardItems[0]->element_position;
            $lastElementPosition = $dashboardItems[0]->element_position;
            for($a=1; $a<count($dashboardItems);$a++){
                if($currentCheckElementPosition > $dashboardItems[$a]->element_position){
                    $betweenArray = $dashboardItems[$a];
                    $dashboardItems[$a] = $currentCheckElement;
                    $dashboardItems[$a-1] = $betweenArray;
                }else{
                    $currentCheckElementPosition = $dashboardItems[$a]->element_position;
                    $currentCheckElement = $dashboardItems[$a];
                    $lastElementPosition = $dashboardItems[$a]->element_position;
                }
            }
        }

        return (object) [
            'dashboardItems' => $dashboardItems,
            'lastElementPosition' => $lastElementPosition
        ];
    }

    /**
     * Get item from zabbix
     *
     * @throws ZabbixException
     */
    public function newAreaChartStore(Request $request)
    {
        $newChart = (object)[];

        date_default_timezone_set("Europe/Riga");
        $date = mktime(date("H")-1, date("i"), date("s"), date("m"), date("d"), date("Y"));
 
        $itemStyle = $request->item_style;
        $elementName = $request->elementName  ?? 'No name';
        $items = $request->items;
        $itemIds = [];
        
        foreach($items as $key=>$value){   
            $itemIds[$key] = $value['item_id'];
        }

        //Get current user ID;
        $currentUserID = $request->session()
        ->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");
  
        //Get user Group
        $userGroup = $request->session()->get("groupId");

        $histories = $this->zabbix->historyGet([
            'output' => 'extend',
            'history' => '0',
            'time_from' => $date,
            'sortorder' => 'DESC',
            'itemids' => $itemIds,
        ]);
        
        $itemHistories = [];
        $historyCount = 0;
        foreach($itemIds as $itemKey=>$value){
            $i = 0;
            $itemid = $value;
            $itemHistories[$historyCount] = [];

            foreach($histories as $key=>$data){
                if($itemid == $data->itemid){
                    $itemHistories[$historyCount][$i] = (object)[];
                    $itemHistories[$historyCount][$i] = $data;
                    $i++;
                }
            }
            $historyCount++;
        }

        $currentDateTime = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));

        $elementId = $currentUserID.$userGroup.$currentDateTime;

        //Store information to data base

        DB::table('dashboard_element')->insert(
            [
             'elementId' => $elementId,
             'itemType' => 2,
             'user' => $currentUserID,
             'group' => $userGroup,
             'element_position' => $request->createdElementPosition,
             'container' => 1,
             'name' => $elementName
            ]
        );
        $units = ['s', 'ms', 'MBps', 'KBps'];
        $newChart->items = [];
        foreach($items as $key=>$value){

            $chartType = $value['chart_type'];
            if($chartType == 'line'){
                $chartType = 1;
            }else{
                $chartType = 2;
            }

            DB::table('dashboard_element_item')->insert(
                [
                'dashboardElement' => $elementId,
                'item' => $value['item_id'],
                'chart_type' => $chartType,
                'unit' => $value['measurementUnit']
                ]
            );

            $checkType = DB::table('monitoring_items')
            ->where('item_id', '=', $value['item_id'])
            ->get('check_type')
            ->first()->check_type;

            $newChart->items[$key] = (object)[
                'chart_type' => $chartType,
                'check_type' => $checkType,
                'item' => $value['item_id'],
                'history' => $itemHistories[$key],
                'symbol' => $units[$value['measurementUnit']-1],
            ];
        }

        $newChart->color = [];
        foreach($itemStyle as $key=>$style){

            DB::table('dashboard_element_style')->insert(
                [
                 'element' => $elementId,
                 'item' => $itemIds[$key],
                 'background_color' => $style['background_color'],
                 'hover_background_color' => $style['hover_background_color'],
                 'border_color' => $style['border_color'],
                 'border_width' => $style['border_width']
                ]
            );

            $newChart->color[$key] = (object)[
                'background' => $style['background_color'],
                'border' => $style['border_color'],
                'borderWidth' => $style['border_width'],
                'hoverBackground' => $style['hover_background_color'],
            ];

        }

        $newChart->container = 1;
        $newChart->elementId = $elementId;
        $newChart->elementPosition = $request->createdElementPosition;
        $newChart->name = $elementName;

        return compact('newChart');
    }

        /**
     * Remove Dashboard element
     *
     * @throws ZabbixException
     */
    public function storeGroupMemberElement(Request $request)
    {

        //Get current user ID;
        $currentUserID = $request->session()
        ->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");
    
        //Get user Group
        $userGroup = $request->session()->get("groupId");

        $currentDateTime = date("dmYHis", time());
        $uniqIdForItem = $currentUserID.$userGroup.$currentDateTime;

        //Store ELEMENT color

        DB::table('dashboard_element')->insert(
            [
                'elementId' => $uniqIdForItem,
                'itemType' => 3,
                'user' => $currentUserID,
                'group' => $userGroup,
                'element_position' => $request->createdElementPosition,
                'container' => 1
            ]
        );


        $groupMembers = DB::table('monitoring_group_members')
            ->join('users', 'users.id', '=', 'monitoring_group_members.group_member')
            ->where('group_id', $userGroup)
            ->get(['name','email_verified_at', 'profile_image', 'id as userID']);

        $itemsInfo = (object) [
            'id' => $uniqIdForItem,
            'members' => $groupMembers
        ];


        return [$itemsInfo];  
    }

    /**
     * Remove Dashboard element
     *
     * @throws ZabbixException
     */
    public function itemRemove(Request $request)
    {
        $elementID = $request->itemId;

        //Get element type
        $deletedElementTypeId = DB::table('dashboard_element')
            ->join('dashboard_element_type', 'itemType', '=', 'item_type_id')
            ->where('elementId', '=', $elementID)
            ->get('item_type_id as element_type')
            ->first()->element_type;

        //Remove element colors form DB
        DB::table("dashboard_element_style")
        ->where('element',$elementID)
        ->delete();

        //Remove zabbix items that was assigned to this dashboard element
        DB::table("dashboard_element_item")
            ->where('dashboardElement',$elementID)
            ->delete();

        //Remove dashboard element
        DB::table("dashboard_element")
            ->where('elementId',$elementID)
            ->delete();

        return $deletedElementTypeId;
    }

    /**
     * Save dashboards elements positions
     *
     * @throws ZabbixException
     */
    public function saveElementsPositions(Request $request)
    {

        $dashbordLeftContainerElementsIds = $request->elementsIds['leftContainer'] ?? [];
        $dashbordRightContainerElementsIds = $request->elementsIds['rightContainer'] ?? [];
        
        if($dashbordLeftContainerElementsIds != null){
            foreach($dashbordLeftContainerElementsIds as $key=>$element){
                $monitors = DB::table('dashboard_element')
                    ->where('elementId', $element)
                    ->update(['element_position' => $key ,'container' => 1 ]); 
            }
        }

        if($dashbordRightContainerElementsIds != null){
            foreach($dashbordRightContainerElementsIds as $key=>$element){
                $monitors = DB::table('dashboard_element')
                    ->where('elementId', $element)
                    ->update(['element_position' => $key, 'container' => 2 ]); 
            }
        }

        return redirect()->back();
    }

    /**
     * Get item from zabbix
     *
     * @throws ZabbixException
     */
    public function lastStatusHistoryGet(Request $request)
    {
        //Get current user ID;
        $currentUserID = $request->session()
            ->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");

        //Get user Group
        $userGroup = $request->session()->get("groupId");//Get current user Group;
        
        $allItems = DB::table('monitoring_monitors')
            ->join('monitoring_hosts', 'monitoring_hosts.host_id', '=', 'monitoring_monitors.host')
            ->join('host_has_application_webscenario', 'host_has_application_webscenario.host_id', '=', 'monitoring_hosts.host_id')
            ->join('monitoring_items', 'monitoring_items.application', '=', 'host_has_application_webscenario.application')
            ->join('monitoring_check_types', 'monitoring_items.check_type', '=', 'monitoring_check_types.id')
            ->where('user_group', $userGroup)
            ->get(['item_id as item','friendly_name','check_type_name','monitor_type']);

        $someValue = $this->getLastChecksHystory($currentUserID, $userGroup);

        $currentStatus = $someValue['currentStatus'];

        $currentDateTime = date("dmYHis", time());
        $uniqIdForItem = $currentUserID.$userGroup.$currentDateTime;

        //Store information to data base
        $currentStatus['id'] = $uniqIdForItem;

        DB::table('dashboard_element')->insert(
            [
                'elementId' => $uniqIdForItem,
                'itemType' => 1,
                'user' => $currentUserID,
                'group' => $userGroup,
                'element_position' => $request->createdElementPosition,
                'container' => 1
            ]
        );

        return compact(['currentStatus','allItems']);
    }

}
