<?php

namespace App\Http\Controllers\Adminlte\user_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserGroupController extends Controller
{
    /**
     * Show user group page.
     *
     * @param Support $support
     * @return Response
     */
    public function show(Request $request)
    {
        //Get current user ID
        $currentUserID = $request
            ->session()
            ->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");

        $groups = DB::table('monitoring_group_members')
            ->join('monitoring_users_groups', 'monitoring_users_groups.group_id', '=', 'monitoring_group_members.group_id')
            ->join('users', 'users.id', '=', 'monitoring_users_groups.group_admin_id')
            ->join('group_member_permission', 'group_member_permission.permission_id', '=', 'monitoring_group_members.group_member_permission')
            ->where('group_member', $currentUserID)
            ->get(['name','email','profile_image', 'gender', 'permission_name as permission', 'group_name', 'monitoring_users_groups.group_id']);

        //Get all groups ids
        $groupIds = [];
        foreach ($groups as $value) {
            array_push($groupIds, $value->group_id);
        }

        $groupMemberCount = DB::table('monitoring_group_members')
            ->select('group_id', DB::raw('count(*) as memberCount'))
            ->whereIn('group_id', $groupIds)
            ->groupBy('group_id')
            ->get();

        foreach ($groups as $key=>$group) {
            $groupId = $group->group_id;
            foreach ($groupMemberCount as $value) {
                if($groupId  == $value->group_id){
                    $groups[$key]->totalMemberCount = $value->memberCount;
                }
            }
        }

        //Host group's id that is currently used
        $hostGroupID = $request->session()->get('hostGroup');

        //Get group id that is currently used
        $usedGroup = DB::table('monitoring_hosts_groups')
            ->where('host_group_id', $hostGroupID)
            ->get()->first()->user_group;

        foreach ($groups as $key=>$group) {
            $groupId = $group->group_id;
            if($groupId == $usedGroup){
                $groups[$key]->currentlyInUse = true;
            }else{
                $groups[$key]->currentlyInUse = false;
            }
        }

        return view('adminlte.user_admin.group.user-group',compact(['groups']));
    }

        /**
     * Change currently in use host group
     *
     * @param Support $support
     * @return Response
     */
    public function changeGroup(Request $request, $groupid)
    {

        // get user id
        $userId = $request
            ->session()
            ->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");

        $userIsMember = DB::table('monitoring_group_members')
            ->where('group_member',$userId)
            ->where('group_id',$groupid)
            ->get('group_member')->first();

        if($userIsMember){
            //Set new group to user to global variable (groupId)
            session(['groupId' => $groupid]);

            $hostGroupID = DB::table('monitoring_hosts_groups')
                ->where('user_group',$groupid)
                ->get('host_group_id')->first()->host_group_id;

            //Set current user host group's id to global variable
            session(['hostGroup' => $hostGroupID]);
        }else{
            return response()->json(['error' => __('You are not the member of the group!')]);
        }


        return $groupid;
    }
}
