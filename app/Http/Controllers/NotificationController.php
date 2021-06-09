<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Becker\Zabbix\ZabbixApi;
use Becker\Zabbix\ZabbixException;

class NotificationController extends Controller
{

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
     * Show user group members page.
     *
     * @param Support $support
     * @return Response
     */
    public function getNotifications(Request $request)
    {
        //Get current user ID
        $currentUserID = $request
            ->session()
            ->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");

        $notifications = DB::table('user_group_request')
            ->join('users', 'users.id', 'user_group_request.requestor')
            ->join('monitoring_users_groups', 'monitoring_users_groups.group_id', 'user_group_request.group')
            ->where('recipient', '=', $currentUserID)
            ->where('status', '=', 1)
            ->get(['name', 'group_name', 'requestID']);

        $requestResponses = DB::table('user_group_request')
            ->join('users', 'users.id', 'user_group_request.recipient')
            ->join('monitoring_users_groups', 'monitoring_users_groups.group_id', 'user_group_request.group')
            ->where('requestor', '=', $currentUserID)
            ->where('status', '!=', 1)
            ->get(['name', 'group_name', 'requestID', 'status']);

        $methodType = 'getNotifications';

        return [$methodType, $notifications, $requestResponses];
    }

        /**
     * Change request status as declined.
     *
     * @param Support $support
     * @return Response
     */
    public function decline(Request $request)
    {
        $requestId = $request->data;
        //Get current user ID
        $currentUserID = $request
            ->session()
            ->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");

        $notifications = DB::table('user_group_request')
            ->where('recipient', '=', $currentUserID)
            ->where('requestID', '=', $requestId)
            ->update(['status' => 2]);

        $methodType = 'requestResponded';
        return [$methodType, $requestId];
    }

    /**
     * Change request status as accepted.
     *
     * @param Support $support
     * @return Response
     */
    public function accept(Request $request)
    {
        $requestId = $request->data;
        
        //Get current user's ID
        $currentUserID = $request
            ->session()
            ->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");

        //Get request group id
        $groupId = DB::table('user_group_request')
            ->where('requestID', $requestId)
            ->get('group')
            ->first()->group;

        DB::table('monitoring_group_members')->insert([
            'group_id' => $groupId,
            'group_member' => $currentUserID,
            'group_member_permission' => 4
        ]);

        $groupMemberZabbixIds = DB::table('monitoring_group_members')
            ->join('users', 'users.id', 'monitoring_group_members.group_member')
            ->join('monitoring_zabbix_users', 'monitoring_zabbix_users.user_id', 'users.id')
            ->where('group_id', $groupId)
            ->get('zabbix_user_id');

        $userids = [];
        foreach ($groupMemberZabbixIds as $key => $value) {
            $userids[$key] = $value->zabbix_user_id;
        }

        //Update zabbix group
        $this->zabbix->usergroupUpdate([
            "usrgrpid" => $groupId,
            "userids" => $userids
        ]);

        $notifications = DB::table('user_group_request')
            ->where('recipient', '=', $currentUserID)
            ->where('requestID', '=', $requestId)
            ->update(['status' => 3]);

        $methodType = 'requestResponded';
        return [$methodType, $requestId];
    }

    /**
     * Remove request
     *
     * @param Support $support
     * @return Response
     */
    public function removeRequest(Request $request)
    {
        $requestId = $request->data;
        //Get current user ID
        $currentUserID = $request
            ->session()
            ->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");

        $notifications = DB::table('user_group_request')
            ->where('requestor', $currentUserID)
            ->where('requestID',  $requestId)
            ->delete();

        $methodType = 'requestResponded';
        return [$methodType, $requestId];
    }
}
