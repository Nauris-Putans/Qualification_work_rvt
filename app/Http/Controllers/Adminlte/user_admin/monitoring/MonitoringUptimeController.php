<?php

namespace App\Http\Controllers\Adminlte\user_admin\monitoring;

use App\Models\Adminlte\user_admin\Monitoring\MonitoringUptime;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Becker\Zabbix\ZabbixApi;
use Becker\Zabbix\ZabbixException;
use Illuminate\Support\Facades\DB;

class MonitoringUptimeController extends Controller
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
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index(Request $request)
    {
        //Get current user ID
        $currentUserID = $request->session()->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");
        
        //Get current user Group
        $usergroupID = $request->session()->get("groupId");

        $itemid = DB::table('monitoring_monitors')
            ->join('monitoring_hosts', 'monitoring_hosts.host_id', '=', 'monitoring_monitors.host')
            ->join('host_has_application_webscenario', 'host_has_application_webscenario.host_id', '=', 'monitoring_hosts.host_id')
            ->join('monitoring_items', 'monitoring_items.application', '=', 'host_has_application_webscenario.application')
            ->where('user_group', $usergroupID)
            ->where('check_type', 2)
            ->get(['item_id as item','monitor_type','friendly_name']);//Get items;
     

        //Get items friendly names
        $itemsFriendlyName = (object) [];
        foreach ($itemid as $value) {
            $key = $value->item;
            $itemsFriendlyName->$key['friendly_name'] = $value->friendly_name;
        }

        $histories = [];
        $monitorType = 0;
        if($itemid->first() != null){
            $monitorType = $itemid[0]->monitor_type;
            $itemid = $itemid[0]->item;
        }else{
            return view('adminlte.user_admin.monitoring.uptime', compact(['histories','itemsFriendlyName']));
        }


        date_default_timezone_set("Europe/Riga");
        $thisMonth  = mktime(0, 0, 0, date("m"), 1, date("Y"));

        $histories = $this->zabbix->historyGet([
            'output' => 'extend',
            'sortorder' => 'DESC',
            'time_from' => $thisMonth,
            'itemids' => $itemid,
        ]);

        if($monitorType != 1){

            foreach ($histories as $key => $value){

                if($histories[$key]->value == 0){
                    $histories[$key]->value = 1;
                }else{
                    $histories[$key]->value = 0;
                }
            }
        }

        return view('adminlte.user_admin.monitoring.uptime', compact(['histories','itemsFriendlyName']));
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
        $currentUserID = $request->session()->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");
        
        //Get current user Group
        $usergroupID = $request->session()->get("groupId");

        //Get item
        $itemid = DB::table('monitoring_monitors')
            ->join('monitoring_hosts', 'monitoring_hosts.host_id', '=', 'monitoring_monitors.host')
            ->join('host_has_application_webscenario', 'host_has_application_webscenario.host_id', '=', 'monitoring_hosts.host_id')
            ->join('monitoring_items', 'monitoring_items.application', '=', 'host_has_application_webscenario.application')
            ->where('user_group', $usergroupID)
            ->where('check_type', 2)
            ->where('item_id', $request->itemId)
            ->get(['item_id','monitor_type'])->first();

        $allItems = DB::table('monitoring_monitors')
            ->join('monitoring_hosts', 'monitoring_hosts.host_id', '=', 'monitoring_monitors.host')
            ->join('host_has_application_webscenario', 'host_has_application_webscenario.host_id', '=', 'monitoring_hosts.host_id')
            ->join('monitoring_items', 'monitoring_items.application', '=', 'host_has_application_webscenario.application')
            ->where('user_group', $usergroupID)
            ->where('check_type', 2)
            ->get(['item_id as item','monitor_type','friendly_name']);//Get items;

            
        //Get items friendly names
        $itemsFriendlyName = (object) [];
        foreach ($allItems as $value) {
            $key = $value->item;
            $itemsFriendlyName->$key['friendly_name'] = $value->friendly_name;
        }
  
        $monitorType = 0;
        if($itemid != null){
            $monitorType = $itemid->monitor_type;
            $itemid = $itemid->item_id;
        }else{
            dd('You dont have any item');
        }
        $period = $request->period;
        date_default_timezone_set("Europe/Riga");
        $monthFrom  = mktime(0, 0, 0, date("m") - $period, 1, date("Y"));
        
        $histories = $this->zabbix->historyGet([
            'output' => 'extend',
            'sortorder' => 'DESC',
            'time_from' => $monthFrom,
            'itemids' => $itemid,
        ]);

        if($monitorType != 1){
            foreach ($histories as $key => $value){

                if($histories[$key]->value == 0){
                    $histories[$key]->value = 1;
                }else{
                    $histories[$key]->value = 0;
                }
            }
        }

        return compact(['histories']);
    }


}
