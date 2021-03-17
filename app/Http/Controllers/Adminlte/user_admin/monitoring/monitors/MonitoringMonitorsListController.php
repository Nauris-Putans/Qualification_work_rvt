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

        $usergroupID = $request->session()->get("groupId");

        $allUserMonitors = DB::table('monitoring_monitors')
            ->join('monitoring_hosts', 'monitoring_hosts.host_id', '=', 'monitoring_monitors.host')
            ->join('monitoring_zabbix_triggers', 'monitoring_zabbix_triggers.host', '=', 'monitoring_hosts.host_id')
            ->join('monitoring_zabbix_actions', 'monitoring_zabbix_actions.zabbix_trigger', '=', 'monitoring_zabbix_triggers.zabbix_triger_id')
            ->join('monitoring_zabbix_actions_has_users', 'monitoring_zabbix_actions_has_users.zabbix_action', '=', 'monitoring_zabbix_actions.zabbix_action_id')
            ->join('monitoring_zabbix_users', 'monitoring_zabbix_users.zabbix_user_id', '=', 'monitoring_zabbix_actions_has_users.user')
            ->join('users', 'users.id', '=', 'monitoring_zabbix_users.user_id')
            ->where('user_group', $usergroupID)
            ->get(['friendly_name','host_id','user_input as check_address','status','name','email','users.id','profile_image']);  

        $allUserMonitorsNoAlertUsers = DB::table('monitoring_monitors')
            ->join('monitoring_hosts', 'monitoring_hosts.host_id', '=', 'monitoring_monitors.host')
            ->where('user_group', $usergroupID)
            ->get(['friendly_name','host_id','user_input as check_address','status']);  

        $alreadyAddedMonitor = [];
        $sortedMonitors = [];
        $monitorKey = 0;
        foreach($allUserMonitors as $key=>$monitor){
            $alreadyAdded = 0;
            foreach($alreadyAddedMonitor as $value){
                if($monitor->host_id == $value){
                    $alreadyAdded = 1;
                }
            }

            if($alreadyAdded){
                $sortedMonitors[$monitorKey]->users[$key] = (object)[];
                $sortedMonitors[$monitorKey]->users[$key]->fullName = $monitor->name;
                $sortedMonitors[$monitorKey]->users[$key]->email = $monitor->email;
                $sortedMonitors[$monitorKey]->users[$key]->id = $monitor->id;
                $sortedMonitors[$monitorKey]->users[0]->profile_image = $monitor->profile_image;
            }else{
                $monitorKey ++;
                $sortedMonitors[$monitorKey] = (object)[];
                $sortedMonitors[$monitorKey]->friendly_name = $monitor->friendly_name;
                $sortedMonitors[$monitorKey]->host_id = $monitor->host_id;
                $sortedMonitors[$monitorKey]->status = $monitor->status;
                $sortedMonitors[$monitorKey]->check_address = $monitor->check_address;
                $sortedMonitors[$monitorKey]->name = $monitor->name;
                $sortedMonitors[$monitorKey]->users[0] = (object)[];
                $sortedMonitors[$monitorKey]->users[0]->fullName = $monitor->name;
                $sortedMonitors[$monitorKey]->users[0]->email = $monitor->email;
                $sortedMonitors[$monitorKey]->users[0]->id = $monitor->id;
                $sortedMonitors[$monitorKey]->users[0]->profile_image = $monitor->profile_image;

                $alreadyAddedMonitor[$key] = $monitor->host_id;
            }
        }

        foreach($allUserMonitorsNoAlertUsers as $monitor){
            $monitorId = $monitor->host_id;
            $alreadyAdded = false;
            foreach($sortedMonitors as $sortMonitor){
                if($monitorId == $sortMonitor->host_id){
                    $alreadyAdded = true;
                }
            }

            if($alreadyAdded == false){
                $monitorKey ++;
                $sortedMonitors[$monitorKey] = $monitor;
                $sortedMonitors[$monitorKey]->users = null;
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

        $hostAplicationWebScenario = DB::table('host_has_application_webscenario')
            ->where('host_id', $monitorId)
            ->get(['application','web_scenario'])->first();

        $webScenario = $hostAplicationWebScenario->web_scenario;
        $application = $hostAplicationWebScenario->application;

        //Remove webHost from database if exists
        if($webScenario != null){
            DB::delete('delete from web_scenarios where httptest_id = ?',[$webScenario]);
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

        DB::delete('delete from monitoring_applications where application_id = ?',[$application]);
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
        $monitor = DB::table('monitoring_monitors')
            ->where('host', $hostId)
            ->get(['status','id'])->first();

        $currentStatus = $monitor->status;
        $hostStatus = 0;
        //Change status type
        if($currentStatus == 1){//monitor active
            $hostStatus = 1;
            $currentStatus = 2;
        }else{
            $hostStatus = 0;
            $currentStatus = 1;
        }

        //Change monitor status
        $monitors = DB::table('monitoring_monitors')
            ->where('id', $monitor->id)
            ->update(['status' => $currentStatus ]); 
       
        //Update Host
        $updatedHost = $this->zabbix->hostUpdate([
            "hostid"=> $hostId,
            "status"=> $hostStatus
        ]);

        return redirect()->back()->with('message', __("Monitor ") . __("status has been changed."));
    }

}
