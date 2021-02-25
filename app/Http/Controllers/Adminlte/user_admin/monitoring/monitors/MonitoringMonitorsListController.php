<?php

namespace App\Http\Controllers\Adminlte\user_admin\monitoring\monitors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Becker\Zabbix\ZabbixApi;
use Becker\Zabbix\ZabbixException;

class MonitoringMonitorsListController extends Controller
{
    //////////////////ZABBIX///////////////////
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
     * Get item from zabbix
     *
     * @throws ZabbixException
     */

     ///////////////////////////////////
    /////////////ZABBIX END//////////////////
    //////////////////////////////////////

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index(Request $request)
    {

        //Get current user Group
        $usergroupID = $request->session()->get("groupId");

        $allUserMonitors = DB::table('monitoring_monitors')
            ->join('monitoring_items', 'monitoring_items.item_id', '=', 'monitoring_monitors.item')
            ->join('monitoring_applications', 'monitoring_applications.application_id', '=', 'monitoring_items.application')
            ->join('host_has_application', 'host_has_application.application', '=', 'monitoring_applications.application_id')
            ->where('user_group', $usergroupID)
            ->get(['friendly_name','host_id','check_address','status']);

        $allUserHosts = DB::table('monitoring_hosts')
            ->join('monitoring_hosts_groups', 'monitoring_hosts_groups.host_group_id', '=', 'monitoring_hosts.host_group')
            ->where('user_group', $usergroupID)
            ->get(['host_id']);

        $sortedMonitors = [];
        $sortedMonitorsCounter = 0;
        foreach($allUserHosts as $value){

            foreach($allUserMonitors as $monitorValue){
                if($monitorValue->host_id == $value->host_id){
                    $sortedMonitors[$sortedMonitorsCounter] = $monitorValue;
                    $sortedMonitorsCounter++;
                    break;
                }
            }

        }

        return view('adminlte.user_admin.monitoring.monitors.monitors-list',compact(['sortedMonitors']));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function deleteMonitor($monitorId, Request $request)
    {

        $hostAplication = DB::table('host_has_application')
            ->where('host_id', $monitorId)
            ->get(['application'])[0]->application;

        $hostWebScenario = DB::table('host_has_web_scenario')
            ->where('host_id', $monitorId)
            ->get(['web_scenario']);

        //Remove webHost from database is exists
        if($hostWebScenario->first() != null){
            $hostWebScenario = $hostWebScenario[0]->web_scenario;
            DB::delete('delete from web_scenarios where httptest_id = ?',[$hostWebScenario]);
        }

        $trigger = DB::table('monitoring_zabbix_triggers')
            ->where('host', $monitorId)
            ->get(['zabbix_triger_id'])[0]->zabbix_triger_id;


        $action = DB::table('monitoring_zabbix_actions')
            ->where('zabbix_trigger', $trigger)
            ->get(['zabbix_action_id']);

        //Delete Host
        $deletedHost = $this->zabbix->hostDelete([
            $monitorId,//Host id
        ]);

        //Delete Action
        if($action->first() != null){
            $action = $action[0]->zabbix_action_id;
            $deletedaction = $this->zabbix->actionDelete([
                $action,//Action id
            ]);
        }

        DB::delete('delete from monitoring_applications where application_id = ?',[$hostAplication]);
        DB::delete('delete from monitoring_zabbix_triggers where zabbix_triger_id = ?',[$trigger]);
        DB::delete('delete from monitoring_hosts where host_id = ?',[$monitorId]);
        
        return redirect()->back()->with('message', __("The monitor #") . __("has been deleted."));
    }


        /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function changeStatus($hostId, Request $request)
    {
        $hostAplication = DB::table('host_has_application')
            ->where('host_id', $hostId)
            ->get(['application'])[0]->application;

        $applicationItems = DB::table('monitoring_items')
            ->where('application', $hostAplication)
            ->get(['item_id']);

        $hostStatus = 0;
        foreach($applicationItems as $item){

            $monitor = DB::table('monitoring_monitors')
                ->where('item', $item->item_id)
                ->get(['status','id']);

            $currentStatus = $monitor[0]->status;
            
            //Change status type
            if($currentStatus == 1){//monitor active
                $hostStatus = 1;
                $currentStatus = 2;
            }else{
                $hostStatus = 0;
                $currentStatus = 1;
            }

            $monitors = DB::table('monitoring_monitors')
                ->where('id', $monitor[0]->id)
                ->update(['status' => $currentStatus ]); 
            
        }
       
        //Update Host
        $updatedHost = $this->zabbix->hostUpdate([
            "hostid"=> $hostId,
            "status"=> $hostStatus
        ]);

        return redirect()->back()->with('message', __("Monitor ") . __("status has been changed."));
    }

}
