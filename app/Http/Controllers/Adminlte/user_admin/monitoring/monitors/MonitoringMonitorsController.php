<?php

namespace App\Http\Controllers\Adminlte\user_admin\monitoring\monitors;

use Illuminate\Support\Facades\DB;
use App\Models\Adminlte\user_admin\Monitoring\Monitors\MonitoringMonitors;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Http\Requests\StoreMonitorsAdd;
use Becker\Zabbix\ZabbixApi;
use Becker\Zabbix\ZabbixException;

class MonitoringMonitorsController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create(Request $request)
    {
        return view('adminlte.user_admin.monitoring.monitors.add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreMonitorsAdd $request)
    {

        //VARIABLES
        $checkType = $request->checkType;//Get check type(DNS on PING) from add Monitor page
        $checkAddress = $request->checkField; //Get DNS or PING address from add Monitor page
        $currentUserID = $request->session()->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");//Get current user ID;
        $checkInterval = $request['intervalSlider']; //Check interval

        //Change https:\\...\ to https://.../
        $checkAddress = str_replace("\\",'/',$checkAddress);

        $usergroupID = DB::table('monitoring_users_groups')->where('group_admin_id', $currentUserID)->get('group_id')->first();//Get current user Group;
        if($usergroupID != null){
            $usergroupID = $usergroupID->group_id;
        }else{
            dd('It is not possible that user dont have Group');
        }

        //Get user current group hostgroup from database
        $hostGroupID = DB::table('monitoring_hosts_groups')->where('user_group','=', $usergroupID)->get('host_group_id')->first();
        
        //If host group exist
        if($hostGroupID != null) {
            //Get host group ID
            $hostGroupID = $hostGroupID->host_group_id;
        }else {
            //Create host group
            $hostGroupID = $this->zabbix->hostgroupCreate([
                "name" => $usergroupID.'-Hosts'
            ])->groupids[0];
            DB::insert('insert into monitoring_hosts_groups (host_group_id, host_group_name, user_group) values (?, ?, ?)', [$hostGroupID, $usergroupID.'-Hosts', $usergroupID]);
        }


        $url = '';
        $dns = '';
        $ip = '';
        $useip = "0";

        if($checkType == "DNS"  || $checkType == "HTTP/HTTPS") {

            $url = $checkAddress;
            $dns = $checkAddress;
            $useip = '0'; 

            //$dns EDIT

            //Remove "https://" or "http://" from $dns
            if(strpos($dns,'https://') !== false) {
                $dns = str_replace("https://",'',$dns);
            }else if(strpos($dns,'http://') !== false) {
                $dns = str_replace("http://",'',$dns);
            }

            //Check that $dns has / , google.com/home/page => google.com
            if(strpos($dns,'/') !== false){
                $FoundId = strpos($dns,'/');
                if(strpos($dns,'/') < 3){
                    dd("Something went wrong");
                }
                $dns = substr($dns,0,$FoundId);
            }

            //If $dns smaller than 3
            if(strlen($dns) < 3){
                dd("something went wrong");
            }

            //Check that domain has "www.", www.google.com => google.com
            if(substr($dns,0,4) === 'www.'){
                $dns = str_replace("www.",'',$dns);;
            }

            
            //$url EDIT

            if(strpos($url,'https://') === false && strpos($url,'http://') === false) {
                $url = "https://".$url;
            }

        }else if($checkType == "ICMP ping") {
            $ip = $checkAddress;
            $useip = '1';
        }else{
            dd('Something went wrong');
        }

        $hostDBCheck = DB::table('monitoring_hosts')->where('host_name',$usergroupID.' '.$dns)->first();

        //CREATE NEW MONITOR IN ZABBIX

        //If host doesnt't exist yet
        if($hostDBCheck == null){


           //Create new Host
            $newHostID = $this->zabbix->hostCreate([
                "host" => $usergroupID.' '.$dns.$ip,
                "interfaces" => [
                    [
                        "type"=> 1,
                        "main"=> 1,
                        "useip"=> $useip,
                        "ip"=> $ip,
                        "dns"=> $dns,
                        "port"=> "10050"
                    ]
                ],
                "groups" => [
                    [
                        "groupid" => $hostGroupID
                    ]
                ]
            ])->hostids[0];
            
            //Create application
            $newApplicationID = $this->zabbix->applicationCreate([
                "name"=> "SimpleCheck", //New application name
                "hostid"=> $newHostID
            ])->applicationids[0];
    
            //Get Host interface ID
            $hostInterfaceID=$this->zabbix->hostinterfaceGet([
                "hostids" => $newHostID
            ])[0]->interfaceid;

            if($checkType == "DNS"  || $checkType == "HTTP/HTTPS")
            {

                $webScenarioStepName = $url;
                //Remove "https://" or "http://" from $webScenarioStepName
                if(strpos($webScenarioStepName,'https://') !== false) {
                    $webScenarioStepName = str_replace("https://",'',$webScenarioStepName);
                }else if(strpos($webScenarioStepName,'http://') !== false) {
                    $webScenarioStepName = str_replace("http://",'',$webScenarioStepName);
                }

                
                $foundId = strpos($webScenarioStepName,'/');
                //Check that $webScenarioStepName has / , if hasn't change $webScenarioStepName to 'Home page'

                if($foundId === false) {
                    $webScenarioStepName = 'Home page';
                }

                //Create new web scenario and steps
                $newWebScenarioID = $this->zabbix->httptestCreate([
                    "name" => $dns." check",
                    "hostid" => $newHostID,
                    "applicationid" => $newApplicationID,
                    "delay" => $checkInterval.'m',   //check time
                    "steps"=> [     //Steps for Web sceanario
                        [
                            "name" => $webScenarioStepName,
                            "url" => $url,
                            "status_codes" => "200",
                            "no" => 1,
                        ],
                    ]
                ])->httptestids[0];
                
                DB::insert('insert into monitoring_hosts (host_id, host_name, check_address, host_group) values (?, ?, ?, ?)', [$newHostID, $usergroupID.' '.$dns, $dns, $hostGroupID]);
                DB::insert('insert into monitoring_applications (application_id, application_name) values (?, ?)', [$newApplicationID, "SimpleCheck"]);
                DB::insert('insert into web_scenarios (httptest_id, httptest_name) values (?, ?)', [$newWebScenarioID, $dns." check"]);
                DB::insert('insert into host_has_application (host_id, application) values (?, ?)', [$newHostID, $newApplicationID]);
                DB::insert('insert into host_has_web_scenario (web_scenario, host_id) values (?, ?)', [$newWebScenarioID, $newHostID]);

                //Get all web scenario's and application's items
                $allItems = $this->zabbix->itemGet([
                    "applicationids" => $newApplicationID,
                    'webitems' => true,
                ]);

                    foreach ($allItems as $item) {

                        if($item->name == 'Download speed for step "$2" of scenario "$1".' && strpos($item->key_, $webScenarioStepName)){
                            DB::insert('insert into monitoring_items (item_id, check_address, check_type, application) values (?, ?, ?, ?)', [$item->itemid, $url, 3, $newApplicationID]);
                            DB::insert('insert into monitoring_monitors (friendly_name, user_group, user_id, item) values (?, ?, ?, ?)', [$request->friendlyName ?? $ip.$url, $usergroupID, $currentUserID, $item->itemid]);
                        }else if($item->name == 'Response code for step "$2" of scenario "$1".' && strpos($item->key_, $webScenarioStepName)){
                            DB::insert('insert into monitoring_items (item_id, check_address, check_type, application) values (?, ?, ?, ?)', [$item->itemid, $url, 2, $newApplicationID]);
                            DB::insert('insert into monitoring_monitors (friendly_name, user_group, user_id, item) values (?, ?, ?, ?)', [$request->friendlyName ?? $ip.$url, $usergroupID, $currentUserID, $item->itemid]);
                        }else if($item->name == 'Response time for step "$2" of scenario "$1".' && strpos($item->key_, $webScenarioStepName)){
                            DB::insert('insert into monitoring_items (item_id, check_address, check_type, application) values (?, ?, ?, ?)', [$item->itemid, $url, 1, $newApplicationID]);
                            DB::insert('insert into monitoring_monitors (friendly_name, user_group, user_id, item) values (?, ?, ?, ?)', [$request->friendlyName ?? $url, $usergroupID, $currentUserID, $item->itemid]);
                        }
                    }
                
            }
            else if($checkType == "ICMP ping") //If user want monitor ping address
            {
                //Create items 
                $ResponseTimeItem = $this->zabbix->itemCreate([
                    "name"=> "ResponseTime",  //Item name
                    "key_"=> "icmppingsec",  //response time check (what to check)
                    "hostid"=> $newHostID,  //Host ID
                    "type"=> 3, //Simple check
                    "value_type"=> 0, //Numeric float
                    "interfaceid"=> $hostInterfaceID,
                    "applications"=> [
                        $newApplicationID //ApplicationID
                    ],
                    "delay"=> $checkInterval.'m'   //check time
                ])->itemids[0];
            
        
                //Create items 
                $UpTimeItem = $this->zabbix->itemCreate([
                    "name"=> "UpTime",  //Item name
                    "key_"=> "icmpping",  //upTime check (what to check)
                    "hostid"=> $newHostID,  //Host ID
                    "type"=> 3, //Simple check
                    "value_type"=> 3, //Numeric unsigned
                    "interfaceid"=> $hostInterfaceID,
                    "applications"=> [
                        $newApplicationID //ApplicationID
                    ],
                    "delay"=> $checkInterval.'m'   //check time
                ])->itemids[0];


                DB::insert('insert into monitoring_hosts (host_id, host_name, check_address, host_group) values (?, ?, ?, ?)', [$newHostID, $usergroupID.' '.$ip, $ip, $hostGroupID]);
                DB::insert('insert into monitoring_applications (application_id, application_name) values (?, ?)', [$newApplicationID, "SimpleCheck"]);
                DB::insert('insert into host_has_application (host_id, application) values (?, ?)', [$newHostID, $newApplicationID]);
                DB::insert('insert into monitoring_items (item_id, check_address, check_type, application) values (?, ?, ?, ?)', [$ResponseTimeItem, $ip, 1, $newApplicationID]);
                DB::insert('insert into monitoring_items (item_id, check_address, check_type, application) values (?, ?, ?, ?)', [$UpTimeItem, $ip, 2, $newApplicationID]);
                DB::insert('insert into monitoring_monitors (friendly_name, user_group, user_id, item) values (?, ?, ?, ?)', [$request->friendlyName ?? $ip, $usergroupID, $currentUserID, $ResponseTimeItem]);
                DB::insert('insert into monitoring_monitors (friendly_name, user_group, user_id, item) values (?, ?, ?, ?)', [$request->friendlyName ?? $ip, $usergroupID, $currentUserID, $UpTimeItem]);

            }else {
                return redirect()->back()->with('message', __('Somenthing get wrong try once more!'));
                dd('error');
            };
            
        }else{
            return redirect()->back()->with('message', __('such thing already exist!'));
            dd('error');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param MonitoringMonitors $monitoringMonitors
     * @return Response
     */
    public function show(MonitoringMonitors $monitoringMonitors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MonitoringMonitors $monitoringMonitors
     * @return Response
     */
    public function edit(MonitoringMonitors $monitoringMonitors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param MonitoringMonitors $monitoringMonitors
     * @return Response
     */
    public function update(Request $request, MonitoringMonitors $monitoringMonitors)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MonitoringMonitors $monitoringMonitors
     * @return Response
     */
    public function destroy(MonitoringMonitors $monitoringMonitors)
    {
        //
    }
}
