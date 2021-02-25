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

    private function getHystoryForAreaChart($allItems, $currentUser, $userGroup){

        date_default_timezone_set("Europe/Riga");
        $date  = mktime(0, 0, 0, date("m"), date("d")-4, date("Y"));

        $itemsGrouped = [];

        $newItem = '';
        $itemExists = 0;
        $i=0;
        $allItemInfo = [];

        //Save different item's ids to '$itemsGrouped' array
        //[31500,31500,12600,31500] => [31500,12600]
        foreach($allItems as $key=>$value) {
            $itemExists = 0;

            //Check if current item was added to '$itemsGrouped' array
            foreach($itemsGrouped as $groupedKey=>$groupedValue) {
                $newItem = $allItemsIds[$key] = $value->item;
                if($newItem == $groupedValue){
                    $itemExists = 1;
                }

            }

            //If current item id is not founded it will be added to '$itemsGrouped' array
            if($itemExists == 0){
                $itemsGrouped[$i] = $value->item;
                $allItemInfo[$i]['id'] = $value->item;
                $allItemInfo[$i]['days_from'] = $value->hystory_from_days;
                $i++;
            }
        }

        $histories = $this->zabbix->historyGet([
            'output' => 'extend',
            'history' => '0',
            'time_from' => $date,
            'sortorder' => 'DESC',
            'itemids' => $itemsGrouped ,
        ]);
        
        foreach($allItems as $key=>$value) {

            $itemId = $value->item;
            $dayFrom = $value->hystory_from_days;
            $date  = mktime(0, 0, 0, date("m"), date("d")-$dayFrom, date("Y"));
            $hystoryLength = sizeof($histories);
            $x=0;
            for($i=0; $i<$hystoryLength;$i++) {
                $currentHystoryDate = $histories[$i]->clock;
 
                if($itemId == $histories[$i]->itemid && $currentHystoryDate >= $date){
                    $allItems[$key]->histories[$x] = $histories[$i];
                    $x++;
                }
            }
        }


        $histories = 1;
        return compact(['allItems']);
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
        $yesterday  = mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));

        //Get current user ID;
        $currentUserID = $userId;

        //Get paused monitors
        $disabledMonitors = DB::table('monitoring_monitors')
            ->where('user_group', $userGroup)
            ->where('status', 2)
            ->get('item');

        $currentStatus['values']['paused'] = $disabledMonitors->count();

        $enabledMonitors = DB::table('monitoring_monitors')
            ->join('monitoring_items', 'monitoring_monitors.item', '=', 'monitoring_items.item_id')
            ->where('user_group', $userGroup)
            ->where('status', 1)
            ->where('check_type', 2)
            ->get(['item','monitor_type']);
    

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
                    if($value->monitor_type == 2){
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

    public function index(Request $request)
    {
        //Get current user ID;
        $currentUserID = $request->session()
            ->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");
 
        //Get user Group ID
        $userGroup = $request->session()->get('groupId');

        $allItems = DB::table('monitoring_monitors')
            ->join('monitoring_items', 'monitoring_monitors.item', '=', 'monitoring_items.item_id')
            ->join('monitoring_check_types', 'monitoring_items.check_type', '=', 'monitoring_check_types.id')
            ->where('user_id', $currentUserID)
            ->where('user_group', $userGroup)
            ->get(['item','friendly_name','check_type_name']);

        $DashboardItemsCurrentCheckStatus = DB::table('monitoring_user_dashboard_items')
            ->join('monitoring_user_dashboard_item_types', 'monitoring_user_dashboard_item_types.item_type_id', '=', 'monitoring_user_dashboard_items.itemType')
            ->where('user', $currentUserID)
            ->where('group', $userGroup)
            ->where('itemType', 1)
            ->get(['item_id','dashboardItemColor']);

        $currentStatusItemsInfo = [];
        foreach ($DashboardItemsCurrentCheckStatus as $key=>$value){
            $someValue = $this->getLastChecksHystory($currentUserID, $userGroup);
            $currentStatusItemsInfo[$key] = $someValue;
            $currentStatusItemsInfo[$key]['id'] = $value->dashboardItemColor;
        }

        $DashboardItemsResponseAndDownloadTime = DB::table('monitoring_user_dashboard_items')
            ->join('monitoring_items', 'monitoring_items.item_id', '=', 'monitoring_user_dashboard_items.item')
            ->join('monitoring_check_types', 'monitoring_items.check_type', '=', 'monitoring_check_types.id')
            ->where('user', $currentUserID)
            ->where('group', $userGroup)
            ->where('itemType', 2)
            ->get(['check_type_name as dataType','item','hystory_from_days','dashboardItemColor as uniqIdForItem']);

            foreach($DashboardItemsResponseAndDownloadTime as $key=>$value) {
                $DashboardItemsResponseAndDownloadTime[$key]->itemColors = DB::table('monitoring_user_dashboard_items_colors')
                ->where('color_id', $DashboardItemsResponseAndDownloadTime[$key]->uniqIdForItem)
                ->get()->first();

                $DashboardItemsResponseAndDownloadTime[$key]->monitorName = DB::table('monitoring_monitors')
                ->where('item', $DashboardItemsResponseAndDownloadTime[$key]->item)
                ->get('friendly_name as monitorName')->first()->monitorName;
            }

        $itemsInfoForAreaChart = $this->getHystoryForAreaChart($DashboardItemsResponseAndDownloadTime, $currentUserID, $userGroup);
        return view('adminlte/user_admin/index',compact(['allItems','currentStatusItemsInfo','itemsInfoForAreaChart']));
    }

    /**
     * Get item from zabbix
     *
     * @throws ZabbixException
     */
    public function newAreaChartStore(Request $request)
    {
        $day = $request->date;
        date_default_timezone_set("Europe/Riga");
        $date  = mktime(0, 0, 0, date("m"), date("d")-$day, date("Y"));
 
        $dataType = $request->data_type;
        $itemColors = $request->item_colors;
        $monitorName = $request->monitorName;


        //Get current user ID;
        $currentUserID = $request->session()
        ->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");
  
        //Get user Group
        $userGroup = $request->session()->get("groupId");//Get current user Group;

        $itemId = $request->itemId;

        $histories = $this->zabbix->historyGet([
            'output' => 'extend',
            'history' => '0',
            'time_from' => $date,
            'sortorder' => 'DESC',
            'itemids' => $itemId,
        ]);

        $currentDateTime = date("dmYHis", time());
        $uniqIdForItem = $currentUserID.$userGroup.$currentDateTime;
        $itemColors['color_id'] = $uniqIdForItem;
        //Store information to data base
        DB::table('monitoring_user_dashboard_items_colors')->insert(
            [
             'color_id' => $uniqIdForItem,
             'header_background_color' => $request->item_colors['header_background_color'],
             'header_text_color' => $request->item_colors['header_text_color'],
             'chart1_background_color' => $request->item_colors['chart1_background_color'],
             'chart1_border_color' => $request->item_colors['chart1_border_color']
            ]
        );

        DB::table('monitoring_user_dashboard_items')->insert(
            [
             'item' => $itemId,
             'dashboardItemColor' => $uniqIdForItem,
             'itemType' => 2,
             'user' => $currentUserID,
             'group' => $userGroup,
             'hystory_from_days' => $request->date
            ]
        );

        return compact(['histories','dataType','itemColors','dataType','monitorName','uniqIdForItem']);
    }

    /**
     * Get item from zabbix
     *
     * @throws ZabbixException
     */
    public function itemRemove(Request $request)
    {
        $itemId = $request->itemId;
        DB::table("monitoring_user_dashboard_items")
            ->where('dashboardItemColor',$itemId)
            ->delete();

        DB::table("monitoring_user_dashboard_items_colors")
            ->where('color_id',$itemId)
            ->delete();

        return $itemId;
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
            ->join('monitoring_items', 'monitoring_monitors.item', '=', 'monitoring_items.item_id')
            ->join('monitoring_check_types', 'monitoring_items.check_type', '=', 'monitoring_check_types.id')
            ->where('user_id', $currentUserID)
            ->where('user_group', 'G1')
            ->get(['item','friendly_name','check_type_name','monitor_type']);

        $someValue = $this->getLastChecksHystory($currentUserID, $userGroup);

        $currentStatus = $someValue['currentStatus'];

        $currentDateTime = date("dmYHis", time());
        $uniqIdForItem = $currentUserID.$userGroup.$currentDateTime;

        //Store information to data base
        DB::table('monitoring_user_dashboard_items_colors')->insert(
            [
                'color_id' => $uniqIdForItem,
            ]
        );

        $currentStatus['id'] = $uniqIdForItem;

        DB::table('monitoring_user_dashboard_items')->insert(
            [
                'dashboardItemColor' => $uniqIdForItem,
                'itemType' => 1,
                'user' => $currentUserID,
                'group' => $userGroup,
                'hystory_from_days' => 1
            ]
        );

        return compact(['currentStatus','allItems']);
    }

}
