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
            ->get(['name','email','profile_image', 'gender', 'zabbix_user_id']);

        return view('adminlte.user_admin.monitoring.monitors.add',compact(['allGroupsUsers']));
    }

    /**
     * Store a new created monitor in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreMonitorsAdd $request)
    {
        //Set date timezone
        date_default_timezone_set("Europe/Riga");

        //Get check type(DNS or PING or http)
        $checkType = $request->checkType;
        //Get DNS or PING address
        $checkAddress = $request->checkAddress; 
        //Check interval
        $checkInterval = $request->checkInterval;

        if($checkInterval > 0){
            $checkInterval = $checkInterval.'m';
        }else{
            $checkInterval = '30s';
        }

        //Get current user ID;
        $currentUserID = $request
            ->session()
            ->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");

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


        if($checkType == "HTTP/HTTPS"){

            // Replace \ to /
            $checkAddress = str_replace("\\",'/',$checkAddress);

            //Remove last char if it is '/'
            if($checkAddress[strlen($dns) - 1] == '/'){
                $checkAddress = substr_replace($checkAddress ,"", -1);
            }

            if(!filter_var($checkAddress, FILTER_VALIDATE_URL)){
                return response()->json(['checkAddress' => __('HTTP(s) is not correct!')]);
            };
    
            if(substr($checkAddress,0,8) != 'https://'){
                if(substr($checkAddress,0,7) != 'http://'){
                    return response()->json(['checkAddress' => __('HTTP(s) is not correct!')]);
                }else{
                    $checkAddress = str_replace('http://', 'https://', $checkAddress);
                }
            }
 
            $dns = $checkAddress;
            $url = $checkAddress;
            $useip = '0'; 

            //Get Domain name from URL
            $parse = parse_url($dns);
            $dns = $parse['host'];

            //Check if domain is correct
            if(!filter_var($dns, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)){
                return response()->json(['checkAddress' => __('HTTP(s) is not correct!')]);
            }


            date_default_timezone_set("Europe/Riga");
            $time = time();
            $time = date("Y-m-d H-m-s",$time);

            $hostName = $usergroupID.' '.$dns.' '.$time;

        }else if($checkType == "DNS"){
            $dns = $checkAddress;
            $useip = '0';
            
            //Check if domain is correct
            if(!filter_var($dns, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)){
                return response()->json(['checkAddress' => __('Domain name is not correct!')]);
            }

            $url = $dns;
            $url = "https://".$url;

            date_default_timezone_set("Europe/Riga");
            $time = time();
            $time = date("Y-m-d H-m-s",$time);

            $hostName = $usergroupID.' '.$dns.' '.$time;
            
        }else if($checkType == "ICMP ping") {//check that ping is written correct
            
            $ip = $checkAddress;
            $useip = '1';
            $hostName = $usergroupID.' '.$ip;

            //Check if ping is correct
            $valid = filter_var($ip, FILTER_VALIDATE_IP);

            if($valid == false){
                return response()->json(['checkAddress' => __('Ping is not correct!')]);
            }
        }else{
            return response()->json(['checkAddress' => __('There is some kind of problem!')]);
        }


        $monitorDBCheck = DB::table('monitoring_monitors')
            ->join('monitoring_hosts', 'monitoring_hosts.host_id', '=', 'monitoring_monitors.host')
            ->where('user_group',$usergroupID)
            ->where('check_address',$ip.$url)
            ->first();

        //CREATE NEW MONITOR IN ZABBIX
        $newHostID = 0;
        
        //If host doesnt't exist yet
        if($monitorDBCheck == null){
            
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
                        "groupid" =>$hostGroupID
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
                    "delay" => $checkInterval,   //check time
                    "steps"=> [     //Steps for Web sceanario
                        [
                            "name" => $webScenarioStepName,
                            "url" => $url,
                            "status_codes" => "200",
                            "no" => 1,
                        ],
                    ]
                ])->httptestids[0];
                
                //Store new host into database
                DB::table('monitoring_hosts')->insert(
                    [
                        'host_id' => $newHostID,
                        'host_name' => $hostName,
                        'check_address' => $url,
                        'host_group' => $hostGroupID
                    ]
                );

                //Store new application into database
                DB::table('monitoring_applications')->insert(
                    [
                        'application_id' => $newApplicationID,
                        'application_name' => 'Web check'
                    ]
                );

                //Store new web scenario into database
                DB::table('web_scenarios')->insert(
                    [
                        'httptest_id' => $newWebScenarioID,
                        'httptest_name' => $dns." check"
                    ]
                );

                //fill out table between aplication,webScenario and host tables
                DB::table('host_has_application_webscenario')->insert(
                    [
                        'host_id' => $newHostID,
                        'application' => $newApplicationID,
                        'web_scenario' => $newWebScenarioID
                    ]
                );

                //Fill out monitoring_monitors table
                DB::table('monitoring_monitors')->insert(
                    [
                        'friendly_name' => $request->friendlyName ?? $url,
                        'user_input' => $checkAddress,
                        'user_group' => $usergroupID,
                        'user_id' => $currentUserID,
                        'host' => $newHostID,
                        'status' => 1,
                        'monitor_type' => 2,
                        'check_interval' => $checkInterval,
                        'updated_at' => date("Y-m-d H:i:s"),
                        'created_at' => date("Y-m-d H:i:s")
                    ]
                );
                
                //Get all web scenario's and application's items
                $allItems = $this->zabbix->itemGet([
                    "applicationids" => $newApplicationID,
                    'webitems' => true,
                ]);
                

                foreach ($allItems as $item) {
                    if($item->name == 'Download speed for step "$2" of scenario "$1".' && strpos($item->key_, $webScenarioStepName)){
                        //insert new download speed item
                        DB::table('monitoring_items')->insert(
                            [
                                'item_id' => $item->itemid,
                                'check_type' => 3,
                                'application' => $newApplicationID,
                            ]
                        );
                    }else if($item->name == 'Failed step of scenario "$1".'){
                        //insert new uptime item
                        DB::table('monitoring_items')->insert(
                            [
                                'item_id' => $item->itemid,
                                'check_type' => 2,
                                'application' => $newApplicationID,
                            ]
                        );
                    }else if($item->name == 'Response time for step "$2" of scenario "$1".' && strpos($item->key_, $webScenarioStepName)){
                        //insert new response time item
                        DB::table('monitoring_items')->insert(
                            [
                                'item_id' => $item->itemid,
                                'check_type' => 1,
                                'application' => $newApplicationID,
                            ]
                        );
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
                    "delay"=> $checkInterval   //check time
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
                    "delay"=> $checkInterval   //check time
                ])->itemids[0];

                //insert new host into database
                DB::table('monitoring_hosts')->insert(
                    [
                        'host_id' => $newHostID,
                        'host_name' => $hostName,
                        'check_address' => $ip,
                        'host_group' => $hostGroupID,
                    ]
                );

                //insert new application into database
                DB::table('monitoring_applications')->insert(
                    [
                        'application_id' => $newApplicationID,
                        'application_name' => 'ping check',
                    ]
                );

                //fill out table between aplication,webScenario and host tables
                DB::table('host_has_application_webscenario')->insert(
                    [
                        'host_id' => $newHostID,
                        'application' => $newApplicationID,
                    ]
                );

                //insert response time item into database
                DB::table('monitoring_items')->insert(
                    [
                        'item_id' => $ResponseTimeItem,
                        'check_type' => 1,
                        'application' => $newApplicationID,
                    ]
                );

                //insert uptime  item into database
                DB::table('monitoring_items')->insert(
                    [
                        'item_id' => $UpTimeItem,
                        'check_type' => 2,
                        'application' => $newApplicationID,
                    ]
                );

                //Fill out monitoring_monitors table
                DB::table('monitoring_monitors')->insert(
                    [
                        'friendly_name' => $request->friendlyName ?? $ip,
                        'user_input' => $checkAddress,
                        'user_group' => $usergroupID,
                        'user_id' => $currentUserID,
                        'host' => $newHostID,
                        'status' => 1,
                        'monitor_type' => 1,
                        'check_interval' => $checkInterval,
                        'updated_at' => date("Y-m-d H:i:s"),
                        'created_at' => date("Y-m-d H:i:s")
                    ]
                );
            }else {
                return response()->json(['error' => __('Somenthing get wrong try once more!')]);
            };
            
        }else{
            return response()->json(['checkAddress' => __('This monitor already exist!')]);
        }
       
        $trigerID = '';
        //Triger create
        if($checkType == "DNS"  || $checkType == "HTTP/HTTPS") {
            $decriptions = (object) [
             'english' => " Monitor:<span>".$checkAddress."</span>
                                <br>
                                Checked URL:<span>".$url."</span>
                            ",
             'latvian' => " Monitors:<span>".$checkAddress."</span>
                            <br>
                            Pārbaudīts URL:<span>".$url."</span>
                            ",
             'russian' => " Монитор:<span>".$checkAddress."</span>
                            <br>
                            Проверенный URL:<span>".$url."</span>
                            ",
            ];

            $email = $request->email;
            $decription = $decriptions->$email;

            //Create triger
            $trigerID = $this->zabbix->triggerCreate([
                "description" => $hostName." is unreachable",
                "comments" => $decription,
                "expression" => '
                                {'.$hostName.':web.test.fail['.$webScenarioName.'].last()}>0
                                or
                                {'.$hostName.':web.test.rspcode['.$webScenarioName.','.$webScenarioStepName.'].last()}<>200
                                ',
                "recovery_mode" => 1,
                "recovery_expression" => '
                                    {'.$hostName.':web.test.fail['.$webScenarioName.'].last()}=0
                                    or
                                    {'.$hostName.':web.test.rspcode['.$webScenarioName.','.$webScenarioStepName.'].last()}=200
                                    ',
            ])->triggerids[0];
        }else{
            $decriptions = (object) [
                'english' => "ICMP PING:<span>".$checkAddress."</span>",
                'latvian' => "ICMP PING:<span>".$checkAddress."</span>",
                'russian' => "ICMP PING:<span>".$checkAddress."</span>",
            ];

            $email = $request->email;
            $decription = $decriptions->$email;

            //Create triger
            $trigerID = $this->zabbix->triggerCreate([
                "description" => $hostName." is unreachable",
                "comments" => $decription,
                "expression" => '{'.$usergroupID.' '.$ip.':icmpping.last()}=0',
                "recovery_mode" => 1,
                "recovery_expression" => '{'.$usergroupID.' '.$ip.':icmpping.last()}>0',
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

            $EmailMediaTypes = (object) [
                'latvian' => 4,
                'english' => 1,
                'russian' => 22
            ];

            $email = $request->email;
            $email = $EmailMediaTypes->$email;

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
                            "mediatypeid"=> $email, //Mail
                        ]
                    ],
                ],
            ])->actionids[0];


            //Insert new created action to database
            DB::table('monitoring_zabbix_actions')->insert(
                [
                    'zabbix_action_id' => $actionID,
                    'zabbix_trigger' => $trigerID
                ]
            );
            $personsIds->$key['userid'];

            $actionAndUserWhoToAlert = [];
            foreach($personsIds as $key=>$person){
                $actionAndUserWhoToAlert[$key] = [];
                $actionAndUserWhoToAlert[$key]['zabbix_action'] = $actionID;
                $actionAndUserWhoToAlert[$key]['user'] = $person['userid'];
            }

            //Add persons who to alert if website is down
            DB::table('monitoring_zabbix_actions_has_users')->insert(
                $actionAndUserWhoToAlert
            );

            //Add meadia type to created action
            DB::table('monitoring_alerts')->insert(
                [
                    'ActionID' => $actionID,
                    'MediaTypeID' => $email
                ]
            );

        }
        
        return response()->json(['message' => __('Monitor has been created!')]);
    }

}
