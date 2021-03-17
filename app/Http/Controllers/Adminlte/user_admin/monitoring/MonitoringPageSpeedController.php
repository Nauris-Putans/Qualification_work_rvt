<?php

namespace App\Http\Controllers\Adminlte\user_admin\monitoring;

use App\Models\Adminlte\user_admin\Monitoring\MonitoringPageSpeed;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Becker\Zabbix\ZabbixApi;
use Becker\Zabbix\ZabbixException;
use Illuminate\Support\Facades\DB;

class MonitoringPageSpeedController extends Controller
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

    /**
     * Get first item hystory and display Response time page
     *
     * @return Application|Factory|Response|View
     */
    public function index(Request $request)
    {
        //Get current user ID
        $currentUserID = $request
        ->session()
        ->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");

        //Get current user Group
        $usergroupID = $request->session()->get("groupId");
        
        //Get items id and friendly name from database
        $items = DB::table('monitoring_monitors')
            ->join('monitoring_hosts', 'monitoring_hosts.host_id', '=', 'monitoring_monitors.host')
            ->join('host_has_application_webscenario', 'host_has_application_webscenario.host_id', '=', 'monitoring_hosts.host_id')
            ->join('monitoring_items', 'monitoring_items.application', '=', 'host_has_application_webscenario.application')
            ->where('user_group', $usergroupID)
            ->where('check_type', 1)
            ->get(['item_id as item','friendly_name']);

        $itemsIds = (object)[];
        $itemsFriendlyName = (object)[];
        
        // If no item was found
        if($items->first() == null){
            $histories = [];
            return view('adminlte.user_admin.monitoring.page-speed', compact(['histories','itemsFriendlyName','itemsIds']));
        }
        
        $firtsItem = $items->first()->item;

        foreach($items as $key=>$value){
            $itemsIds->$key['item_id'] = $value->item;
            $nameId = $value->item;
            $itemsFriendlyName->$nameId['friendly_name'] = $value->friendly_name;
        }

        date_default_timezone_set("Europe/Riga");
        $yesterday  = mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));

        $histories = $this->zabbix->historyGet([
            'output' => 'extend',
            'history' => '0',
            'sortorder' => 'DESC',
            'time_from' => $yesterday,
            'itemids' => $firtsItem,
        ]);

        return view('adminlte.user_admin.monitoring.page-speed', compact(['histories','itemsFriendlyName','itemsIds']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        //Get current user ID
        $currentUserID = $request
        ->session()
        ->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");

        //Get current user Group
        $usergroupID = $request->session()->get("groupId");
        
        //Get selected item id
        $selectedId = $request->item_id;

        //Get items id and friendly name from database
        $items = DB::table('monitoring_monitors')
            ->join('monitoring_hosts', 'monitoring_hosts.host_id', '=', 'monitoring_monitors.host')
            ->join('host_has_application_webscenario', 'host_has_application_webscenario.host_id', '=', 'monitoring_hosts.host_id')
            ->join('monitoring_items', 'monitoring_items.application', '=', 'host_has_application_webscenario.application')
            ->where('user_group', $usergroupID)
            ->where('check_type', 1)
            ->get(['item_id as item','friendly_name']);
    
        $itemsIds = (object)[];
        $itemsFriendlyName = (object)[];
        $histories = (object)[];

        // If no item was found
        if($items->first() == null){
            return compact(['histories','itemsFriendlyName','itemsIds']);
        }

        foreach($items as $key=>$value){
            $itemsIds->$key['item_id'] = $value->item;
            $nameId = $value->item;
            $itemsFriendlyName->$nameId['friendly_name'] = $value->friendly_name;
        }

        $histories = $this->zabbix->historyGet([
            'output' => 'extend',
            'history' => '0',
            'time_from' => $request->startDate,
            'time_till' => $request->endDate,
            'sortorder' => 'DESC',
            'itemids' => $selectedId,
        ]);

        return compact(['histories','itemsFriendlyName','itemsIds','selectedId']);
    }

}
