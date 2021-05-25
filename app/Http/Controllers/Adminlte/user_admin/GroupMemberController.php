<?php

namespace App\Http\Controllers\Adminlte\user_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupMemberController extends Controller
{
    /**
     * Show user group members page.
     *
     * @param Support $support
     * @return Response
     */
    public function show($groupId, Request $request)
    {
        $users = DB::table('users')
            ->join('monitoring_group_members', 'monitoring_group_members.group_member','=','users.id')
            ->join('group_member_permission', 'group_member_permission.permission_id','=','monitoring_group_members.group_member_permission')
            ->join('countries', 'countries.id', '=', 'users.country')
            ->where('group_id', $groupId)
            ->get(['group_member', 'group_id', 'permission_name as permission', 'phone_number', 'users.name', 'gender', 'email', 'profile_image', 'countries.name as country', 'city']);

        // return redirect()->route('userGroup.show');
        return view('adminlte.user_admin.group.user-group-control',compact(['users', 'groupId']));
    }


    /**
     * find users that has similat input email.
     *
     * @param Support $support
     * @return Response
     */
    public function findUsers(Request $request)
    {

        $emailLike = $request->emailToFind;
        $emailLike = '%'.$emailLike.'%';

        $group = $request->group;

        $users = DB::table('users')
            ->join('countries', 'countries.id', '=', 'users.country')
            ->where('email', 'like', $emailLike)
            ->get(['phone_number', 'users.name', 'gender', 'email', 'profile_image', 'users.id']);
        
        $userIds = [];
        foreach ($users as $key=>$value){
            $userIds[$key] = $value->id;
        }

        //Check that members already have request to join
        $usersIsRequested = DB::table('user_group_request')
            ->whereIn('recipient', $userIds)
            ->where('group', '=', $group)
            ->where('status', '=', '1')
            ->get('recipient');

        foreach ($usersIsRequested as $requestPerson){
            foreach ($users as $key=>$value){
                if($value->id == $requestPerson->recipient) {
                    $users[$key]->request = 'requested';
                }
            }
        }

        //Check that members already is member of the group
        $usersInGroup = DB::table('monitoring_group_members')
            ->where('group_id', '=', $group)
            ->whereIn('group_member', $userIds)
            ->get('group_member'); 

        foreach ($usersInGroup as $member){
            foreach ($users as $key=>$value){
                if($value->id == $member->group_member) {
                    $users[$key]->request = 'member';
                }
            }
        }

        return $users;
    }


    /**
     * Invite new user.
     *
     * @param Support $support
     * @return Response
     */
    public function inviteUser(Request $request)
    {
        //get user id who to invite
        $selectedUser = $request->user;

        //Get group id in which user is invited
        $group = $request->group;

        date_default_timezone_set("Europe/Riga");

        //Add request to database
        DB::table('user_group_request')->insert([
            'recipient' => $selectedUser,
            'group' => $group,
            'status' => 1,
            'created_at'=> date('Y-m-d H:i:s')
        ]);

        return $selectedUser;
    }
}
