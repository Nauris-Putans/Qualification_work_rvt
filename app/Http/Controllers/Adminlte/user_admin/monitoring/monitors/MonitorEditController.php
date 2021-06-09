<?php

namespace App\Http\Controllers\Adminlte\user_admin\monitoring\monitors;

use Becker\Zabbix\ZabbixApi;
use Illuminate\Http\Request;

use Becker\Zabbix\ZabbixException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MonitorEditController extends Controller
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

    public function show($hostId, Request $request){

        //Get current user Group
        $usergroupID = $request->session()->get("groupId");

        $groupMembers = DB::table('monitoring_group_members')
            ->join('users','users.id','=','monitoring_group_members.group_member')
            ->where('group_id', $usergroupID)
            ->get(['group_member as userID', 'name', 'email', 'profile_image', 'gender']);

        $monitor = DB::table('monitoring_monitors')
            ->where('host',$hostId)
            ->where('user_group', $usergroupID)
            ->get(['user_input', 'friendly_name', 'host', 'check_interval', 'monitor_type'])
            ->first();

        $alertLanguage = DB::table('monitoring_zabbix_triggers')
            ->join('monitoring_zabbix_actions', 'monitoring_zabbix_actions.zabbix_trigger', '=', 'monitoring_zabbix_triggers.zabbix_triger_id')
            ->join('monitoring_alerts', 'monitoring_alerts.ActionID', '=', 'monitoring_zabbix_actions.zabbix_action_id')
            ->join('zabbix_mediatypes', 'zabbix_mediatypes.MediatypesID', '=', 'monitoring_alerts.MediaTypeID')
            ->join('languages', 'languages.LanguageID', '=', 'zabbix_mediatypes.Language')
            ->where('host',$hostId)
            ->get('languages.Name')
            ->first();

        if($alertLanguage){
            $alertLanguage = $alertLanguage->Name;
        }


        $alertPersonsIds = DB::table('monitoring_zabbix_triggers')
            ->join('monitoring_zabbix_actions', 'monitoring_zabbix_actions.zabbix_trigger', '=', 'monitoring_zabbix_triggers.zabbix_triger_id')
            ->join('monitoring_zabbix_actions_has_users', 'monitoring_zabbix_actions_has_users.zabbix_action', '=', 'monitoring_zabbix_actions.zabbix_action_id')
            ->join('monitoring_zabbix_users', 'monitoring_zabbix_users.zabbix_user_id', '=', 'monitoring_zabbix_actions_has_users.user')
            ->where('host',$hostId)
            ->get('user_id');

        $groupedPersons = (object) [
            'reciveAlertPersons' => [],
            'noReciveAlertPersons' => [],
        ];

        $alertPersonCount = 0;
        $noAlertPersonCount = 0;
        foreach($groupMembers as $person){
            $isAddedAsPersonToAlert = false;

            foreach($alertPersonsIds as $personToAlert){
                if($personToAlert->user_id == $person->userID){
                    $groupedPersons->reciveAlertPersons[$alertPersonCount] = $person;
                    $isAddedAsPersonToAlert = true;
                    $alertPersonCount++;
                }
            }

            if( $isAddedAsPersonToAlert == false){
                $groupedPersons->noReciveAlertPersons[$noAlertPersonCount] = $person;
                $noAlertPersonCount++;
            }
        }

        return view('adminlte.user_admin.monitoring.monitors.monitor-edit',compact(['groupedPersons','monitor', 'alertLanguage']));
    }

    private function updateZabbixWebScenario($hostId, $newCheckInterval){
        //Find in database webScenario that belongs to host
        $webScenarioID = DB::table('host_has_application_webscenario')
            ->where('host_id', '=', $hostId)
            ->get('web_scenario')
            ->first()->web_scenario;

        //If webscenario exist then it will be updated with new data
        if($webScenarioID){
            $this->zabbix->httptestupdate([
                "httptestid" => $webScenarioID,
                "delay" => $newCheckInterval
            ]);
        }else{
            return 'smthWrong';
        }
    }

    private function updateZabbixItems($hostId, $newCheckInterval){
        //Find in database all items that belongs to host
        $items = DB::table('monitoring_items')
            ->join('host_has_application_webscenario','host_has_application_webscenario.application', '=', 'monitoring_items.application')
            ->where('host_id', '=', $hostId)
            ->get('item_id');

        //If there is at least one item then it(they) will be updated with new data
        if($items){
            foreach($items as $key=>$value){
                $this->zabbix->itemupdate([
                    "itemid" => $value->item_id,
                    "delay" => $newCheckInterval
                ]);
            }
        }else{
            return 'smthWrong';
        }
    }

    private function updateZabbixWebSiteTrigger($hostId, $emailLanguage, $monitorName){

        //Get monitor checked url address
        $url = DB::table('monitoring_hosts')
            ->where('host_id', '=', $hostId)
            ->get('check_address')
            ->first()->check_address;

        $decriptions = (object) [
            'english' => " <p>Monitor:  ".$monitorName."</p>
                                <br>
                            <p>Checked URL:  ".$url."</p>
                            ",
            'latvian' => " <p>Monitors:  ".$monitorName."</p>
                            <br>
                            <p>Pārbaudītais URL:  ".$url."</p>
                            ",
            'russian' => " <p>Монитор:  ".$monitorName."</p>
                            <br>
                            <p>Проверенный URL:  ".$url."</p>
                            ",
        ];

        $decription = $decriptions->$emailLanguage;

        //Get zabbix triger ID
        $triggerID = DB::table('monitoring_zabbix_triggers')
            ->where('host', '=', $hostId)
            ->get('zabbix_triger_id')
            ->first()->zabbix_triger_id;

        //Update zabbix trigger
        $this->zabbix->triggerUpdate([
            "triggerid" => $triggerID,
            "comments" => $decription
        ]);
    }

    private function updateZabbixPingTrigger($hostId, $emailLanguage, $monitorName){
        //Get monitor checked ping
        $ping = DB::table('monitoring_hosts')
            ->where('host_id', '=', $hostId)
            ->get('check_address')
            ->first()->check_address;

        $decriptions = (object) [
            'english' => "<p>Monitor:  ".$monitorName."</p>
                        <br>
                          <p>ICMP PING:  ".$ping."</p>
                        ",
            'latvian' => "<p>Monitors:  ".$monitorName."</p>
                        <br>
                          <p>ICMP PING:  ".$ping."</p>
                         ",
            'russian' => "<p>Монитор:".$monitorName."</p>
                        <br>
                          <p>ICMP PING:  ".$ping."</p>
                         ",
        ];

        $decription = $decriptions->$emailLanguage;

        //Get zabbix triger ID
        $triggerID = DB::table('monitoring_zabbix_triggers')
            ->where('host', '=', $hostId)
            ->get('zabbix_triger_id')
            ->first()->zabbix_triger_id;
        
        //Update zabbix trigger
        $actionID = $this->zabbix->triggerUpdate([
            "triggerid" => $triggerID,
            "comments" => $decription
        ]);
    }

    private function getZabbixUserIdFromUserId($alertPersons){
        $zabixUsers = (object)[];

        if(empty($alertPersons) != true){
            $zabixUsers = DB::table('monitoring_zabbix_users')
                ->whereIn('user_id',$alertPersons)
                ->get('zabbix_user_id');
        }

            
        $alertPersons = [];
        foreach($zabixUsers as $key=>$value){
            $alertPersons[$key] = $value->zabbix_user_id;
        }

        return $alertPersons;
    }

    private function removeAllUsersRecivingAlertsFromActionInDB($zabbixActionId){

        //Remove all users who belongs to zabbix action in DB
        if($zabbixActionId != null){
            $zabbixActionId = $zabbixActionId->zabbix_action_id;

            $oldPersonsToAlert = DB::table('monitoring_zabbix_actions_has_users')
                ->where('zabbix_action', '=', $zabbixActionId)
                ->get();

            if(empty($oldPersonsToAlert) != true){
                DB::delete('delete from monitoring_zabbix_actions_has_users where zabbix_action = ?',[$zabbixActionId]);
            }
        }

    }

    private function removeZabbixAction($zabbixActionId){

        //Delete action in zabbix
        $actionID = $this->zabbix->actionDelete([
            "actionid"=> $zabbixActionId,
        ]);

        //Delete action in Database
        DB::delete('delete from monitoring_zabbix_actions where zabbix_action_id = ?',[$zabbixActionId]);
    }

    private function creatZabbixAction($personsToAlert, $trigerID){

        $personsIds = (object) [];
        foreach ($personsToAlert as $key=>$person){
            $personsIds->$key['userid'] = $person;
        };

        $hostName = $trigerID." action";

        // Actio create
        $actionID = $this->zabbix->actionCreate([
            "name"=> $hostName,
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

        return $actionID;
    }

    private function updateMonitor(Request $request){

        $hostId = $request->monitor['host'];
        $checkInterval = $request->checkInterval;

        if($checkInterval > 0){
            $checkInterval = $checkInterval.'m';
        }else{
            $checkInterval = '30s';
        }
        $friendlyName = $request->friendlyName;
        $monitorType = $request->monitor['monitor_type'];
        $emailLanguage = $request->email;
        $meadiaTypes = (object)[
            'english' => 1,
            'latvian' => 4,
            'russian' => 22
        ];

        if($monitorType != 1){ //If monitor type is URL or DNS
            $this->updateZabbixWebScenario($hostId, $checkInterval);
            $this->updateZabbixWebSiteTrigger($hostId, $emailLanguage, $friendlyName);
        }else{
            $this->updateZabbixItems($hostId, $checkInterval);
            $this->updateZabbixPingTrigger($hostId, $emailLanguage, $friendlyName);
        }

        //Change monitor info in database
        DB::table('monitoring_monitors')
            ->where('host',$hostId)
            ->update(['check_interval' => $checkInterval, 'friendly_name' =>  $friendlyName ]); 

        $alertPersons = $request->personsToAlert;
        $zabbixUserId = $this->getZabbixUserIdFromUserId($alertPersons);

        $zabbixActionId = DB::table('monitoring_zabbix_triggers')
            ->join('monitoring_zabbix_actions', 'monitoring_zabbix_actions.zabbix_trigger', '=', 'monitoring_zabbix_triggers.zabbix_triger_id')
            ->where('host', '=', $hostId)
            ->get('zabbix_action_id')
            ->first();
            
        $this->removeAllUsersRecivingAlertsFromActionInDB($zabbixActionId);

        if(empty($alertPersons) != true){
 
            $trigerID = DB::table('monitoring_zabbix_triggers')
                ->where('host', '=', $hostId)
                ->get('zabbix_triger_id')
                ->first()->zabbix_triger_id;
                
            if($zabbixActionId == null){

                $actionID = $this->creatZabbixAction($alertPersons, $trigerID);

                DB::table('monitoring_zabbix_actions')->insert(
                    [
                        'zabbix_action_id' => $actionID,
                        'zabbix_trigger' =>  $trigerID
                    ]
                );

                DB::table('monitoring_alerts')->insert(
                    [
                        'ActionID' => $actionID,
                        'MediaTypeID' =>  $meadiaTypes->$emailLanguage
                    ]
                );
                
                foreach ($zabbixUserId as $key=>$person){
                    DB::table('monitoring_zabbix_actions_has_users')->insert(
                        [
                            'user' => $person,
                            'zabbix_action' => $actionID
                        ]
                    );
                };

            }else{
                $zabbixActionId = $zabbixActionId->zabbix_action_id;

                $personsIds = (object) [];
                foreach ($zabbixUserId as $key=>$value){
                    $personsIds->$key['userid'] = $value;
                };

                // Update existing action
                $this->zabbix->actionUpdate([
                    "actionid"=> $zabbixActionId,
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
                                "mediatypeid"=> $meadiaTypes->$emailLanguage //Mail
                            ]
                        ],
                    ],
                ]);

                foreach ($zabbixUserId as $key=>$value){
                    DB::table('monitoring_zabbix_actions_has_users')->insert(
                        [
                            'user' => $value,
                            'zabbix_action' => $zabbixActionId
                        ]
                    );
                };

                DB::table('monitoring_alerts')
                    ->where('ActionID', $zabbixActionId)
                    ->update(['MediaTypeID' =>  $meadiaTypes->$emailLanguage]); 
            }

        }else if($zabbixActionId != null){

            $zabbixActionId = $zabbixActionId->zabbix_action_id;
            $this->removeZabbixAction($zabbixActionId);
        }

        //Get current user ID;
        $currentUserID = $request
        ->session()
        ->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");

        //Get current user's group id
        $usergroupID = $request->session()->get('groupId');

        //Add current user activity(create monitor) to log file
        DB::table('user_activity_log')->insert([
            'userID' => $currentUserID,
            'groupID' => $usergroupID ,
            'function' => 'edited monitor',
            'decription' => $friendlyName,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        return response()->json(['message' => __('Monitor has been updated!')]);
    }

    private function updatePingMonitor($data){

        return 1;
    }

    public function update(Request $request){

        $smth = $this->updateMonitor($request);

        return response()->json($smth);
    }
}
