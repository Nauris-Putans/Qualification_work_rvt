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

        //Get current user Group
        $usergroupID = $request->session()->get("groupId");

        //Get user group's hostgroup id
        $hostGroupID = $request->session()->get('hostGroup');

        $allGroupsUsers = DB::table('monitoring_group_members')
            ->join('users', 'users.id', '=', 'monitoring_group_members.group_member')
            ->join('monitoring_zabbix_users', 'monitoring_group_members.group_member', '=', 'monitoring_zabbix_users.user_id')
            ->where('group_id', $usergroupID)
            ->get(['name','email','profile_image','zabbix_user_id']);

        return view('adminlte.user_admin.monitoring.monitors.add',compact(['allGroupsUsers']));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreMonitorsAdd $request)
    {

        //VARIABLES
        $checkType = $request->checkType;//Get check type(DNS or PING or http) from add Monitor page
        $checkAddress = $request->checkAddress; //Get DNS or PING address from add Monitor page
        $currentUserID = $request->session()->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");//Get current user ID;
        $checkInterval = $request->checkInterval; //Check interval

        //Get current user's group id
        $usergroupID = $request->session()->get('groupId');

        //Get user group's hostgroup id
        $hostGroupID = $request->session()->get('hostGroup');

        $url = '';
        $dns = '';
        $ip = '';
        $useip = "0";//1 is ip , 0 is dns and https
        $hostName = '';
        $webScenarioName = '';
        $webScenarioStepName = '';

        if($checkType == "DNS"  || $checkType == "HTTP/HTTPS") {

            //Change https:\\...\ to https://.../
            $checkAddress = str_replace("\\",'/',$checkAddress);

            $url = $checkAddress;
            $dns = $checkAddress;
            $useip = '0'; 

            //Remove "https://" or "http://" from $dns
            if(strpos($dns,'https://') !== false) {
                $dns = str_replace("https://",'',$dns);
            }else if(strpos($dns,'http://') !== false) {
                $dns = str_replace("http://",'',$dns);
            }

            //Check that domain has "www.", www.google.com => google.com
            if(substr($dns,0,4) === 'www.'){
                $dns = str_replace("www.",'',$dns);
            }
             
            $hostName = $usergroupID.' '.$dns;

            //Change webCheck/notification.com to webCheck.notification.com
            $hostName = str_replace("/",'.',$hostName);

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
                return response()->json(['error' => __('Something is not good!')]);
            }

            if(strpos($url,'https://') === false && strpos($url,'http://') === false) {
                $url = "https://".$url;
            }

        }else if($checkType == "ICMP ping") {//check that ping is written correct
            
            $ip = $checkAddress;

            //Ping should contain not more than 15 characters
            if(strlen($ip) > 15){
                return response()->json(['checkAddress' => __('Ping is not correct!')]);
            }

            //Count points in string, can be not more or less than three
            if(substr_count($ip,'.') > 3 || substr_count($ip,'.') < 3){
                return response()->json(['checkAddress' => __('Ping is not correct!')]);
            }

            $pingInParts = ['','','',''];
            $useip = '1';
            $trueEterationsCount = 0;
            $startPos = 0;
            
            for($i=0; $i<3; $i++){
                $pointPosition = strpos($ip, '.', $startPos);

                $pingInParts[$i] = substr($ip,$startPos,$pointPosition-$startPos);
                $startPos = $pointPosition+1;
            }

            $pingInParts[3] = substr($ip,$startPos);

            foreach ($pingInParts as $value) {
                if(is_numeric($value)){
                    if($value <= 255){
                        $trueEterationsCount++;
                    }
                }
            }

            if($trueEterationsCount != 4){
                return response()->json(['checkAddress' =>__('Ping is not correct!')]);
            }

            $hostName = $usergroupID.' '.$ip;
        }else{
            dd('Something went wrong');
        }


        $hostDBCheck = DB::table('monitoring_hosts')->where('host_name',$hostName)->first();

        //CREATE NEW MONITOR IN ZABBIX
        $newHostID = 0;
        //If host doesnt't exist yet
        if($hostDBCheck == null){

           //Create new Host
            $newHostID = $this->zabbix->hostCreate([
                "host" => $hostName,
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
                }else{
                    $webScenarioStepName = 'Home page';
                }

                $webScenarioName = $dns." check";
                //Create new web scenario and steps
                $newWebScenarioID = $this->zabbix->httptestCreate([
                    "name" =>  $webScenarioName,
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
                
                DB::insert('insert into monitoring_hosts (host_id, host_name, check_address, host_group) values (?, ?, ?, ?)', [$newHostID, $hostName, $dns, $hostGroupID]);
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
                            DB::insert('insert into monitoring_items (item_id, check_address, check_type, monitor_type, application) values (?, ?, ?, ?, ?)', [$item->itemid, $url, 3, 2, $newApplicationID]);
                            DB::insert('insert into monitoring_monitors (friendly_name, user_group, user_id, item, status) values (?, ?, ?, ?, ?)', [$request->friendlyName ?? $ip.$url, $usergroupID, $currentUserID, $item->itemid,1]);
                        }else if($item->name == 'Failed step of scenario "$1".'){
                            DB::insert('insert into monitoring_items (item_id, check_address, check_type, monitor_type, application) values (?, ?, ?, ?, ?)', [$item->itemid, $url, 2, 2, $newApplicationID]);
                            DB::insert('insert into monitoring_monitors (friendly_name, user_group, user_id, item, status) values (?, ?, ?, ?, ?)', [$request->friendlyName ?? $ip.$url, $usergroupID, $currentUserID, $item->itemid, 1]);
                        }else if($item->name == 'Response time for step "$2" of scenario "$1".' && strpos($item->key_, $webScenarioStepName)){
                            DB::insert('insert into monitoring_items (item_id, check_address, check_type, monitor_type, application) values (?, ?, ?, ?, ?)', [$item->itemid, $url, 1, 2, $newApplicationID]);
                            DB::insert('insert into monitoring_monitors (friendly_name, user_group, user_id, item, status) values (?, ?, ?, ?, ?)', [$request->friendlyName ?? $url, $usergroupID, $currentUserID, $item->itemid, 1]);
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

                
                DB::insert('insert into monitoring_hosts (host_id, host_name, check_address, host_group) values (?, ?, ?, ?)', [$newHostID, $hostName, $ip, $hostGroupID]);
                DB::insert('insert into monitoring_applications (application_id, application_name) values (?, ?)', [$newApplicationID, "SimpleCheck"]);
                DB::insert('insert into host_has_application (host_id, application) values (?, ?)', [$newHostID, $newApplicationID]);
                DB::insert('insert into monitoring_items (item_id, check_address, check_type, monitor_type, application) values (?, ?, ?, ?, ?)', [$ResponseTimeItem, $ip, 1, 1, $newApplicationID]);
                DB::insert('insert into monitoring_items (item_id, check_address, check_type, monitor_type, application) values (?, ?, ?, ?, ?)', [$UpTimeItem, $ip, 2, 1, $newApplicationID]);
                DB::insert('insert into monitoring_monitors (friendly_name, user_group, user_id, item, status) values (?, ?, ?, ?, ?)', [$request->friendlyName ?? $ip, $usergroupID, $currentUserID, $ResponseTimeItem, 1]);
                DB::insert('insert into monitoring_monitors (friendly_name, user_group, user_id, item, status) values (?, ?, ?, ?, ?)', [$request->friendlyName ?? $ip, $usergroupID, $currentUserID, $UpTimeItem, 1]);

            }else {
                return response()->json(['error' => __('Somenthing get wrong try once more!')]);
            };
            
        }else{
            return response()->json(['checkAddress' => __('This monitor already exist!')]);
        }

        $trigerID = '';
        //Triger create
        if($checkType == "DNS"  || $checkType == "HTTP/HTTPS") {
            //Create triger
            $trigerID = $this->zabbix->triggerCreate([
                "description" => $hostName." is unreachable",
                "expression" => '
                                {'.$hostName.':web.test.fail['.$webScenarioName.'].last()}>0
                                or
                                {'.$hostName.':web.test.rspcode['.$webScenarioName.','.$webScenarioStepName.'].last()}<>200
                                ',
            ])->triggerids[0];
        }else{
            //Create triger
            $trigerID = $this->zabbix->triggerCreate([
                "description" => $hostName." is unreachable",
                "expression" => '{'.$usergroupID.' '.$ip.':icmpping.last()}=0',
            ])->triggerids[0];
        }

        DB::insert('insert into monitoring_zabbix_triggers (zabbix_triger_id, host) values (?, ?)', [$trigerID, $newHostID]);


        
        $personsToAlert = $request->personsToAlert;//Get all persons to alert

        $personsIds = (object) [];

        $counter = 0;
        if($personsToAlert != null){
            foreach ($personsToAlert as $key=>$value){
                $personsIds->$key['userid'] = $value['zabbix_user_id'];
                $counter++;
            }
        }

        if($counter != 0){
            // Actio create
            $actionID = $this->zabbix->actionCreate([
                "name"=> $hostName." action",
                "eventsource"=> 0,
                "status"=> 0,
                "esc_period"=> "2m",
                "filter"=> [
                    "evaltype"=> 2,
                    "conditions"=> [
                        [
                            "conditiontype"=> 2,
                            "operator"=> 0,
                            "value"=> $trigerID
                        ]
                    ]
                ],
                "operations"=> [
                    [
                        "operationtype"=> 0, //Send mesage
                        "esc_period"=> "0s", //Duration of an escalation step in seconds
                        "esc_step_from"=> 1,//Step to start escalation from (Default: 1).
                        "esc_step_to"=> 1, //Step to end escalation at (Default: 1).
                        "evaltype"=> 0,
                        "opmessage_usr"=> $personsIds, //Who to send mesage
                        "opmessage"=> [
                            "default_msg"=> 1,
                            "mediatypeid"=> "1" //Mail
                        ]
                    ],
                ],
            ])->actionids[0];
            
            DB::insert('insert into monitoring_zabbix_actions (zabbix_action_id, zabbix_trigger) values (?, ?)', [$actionID, $trigerID]);

        }
        
        return response()->json(['message' => __('Monitor has been created!')]);
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
