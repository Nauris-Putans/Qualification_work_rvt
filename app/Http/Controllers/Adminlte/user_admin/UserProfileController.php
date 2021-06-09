<?php

namespace App\Http\Controllers\Adminlte\user_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index($id, Request $request)
    {
        date_default_timezone_set("Europe/Riga");
        $MonthNames = array(
            __('January'),
            __('February'),
            __('March'),
            __('April'),
            __('May'),
            __('June'),
            __('July'),
            __('August'),
            __('September'),
            __('October'),
            __('November'),
            __('December'),
        );


        //Get current user's group id
        $usergroupID = $request->session()->get('groupId');

        $userInfo = DB::table('users')
            ->join('countries', 'countries.id', '=', 'users.id')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->where('users.id',$id)
            ->get(['users.name as fullName','email','roles.display_name','profile_image','phone_number','gender','birthday','countries.name as country','city']);

        $logs = DB::table('user_activity_log')
            ->join('users', 'users.id', 'userID')
            ->where('userID', $id)
            ->where('groupID', $usergroupID)
            ->orderBy('user_activity_log.created_at', 'desc')
            ->get(['name', 'function', 'decription', 'user_activity_log.created_at' ]);

        $logsGroupedByDate = (object)[];
        $lastDate = 0;
        $objectElement = 0;
        $key = 0;
        foreach ($logs as $value) {
            $dateToTimestamp = strtotime($value->created_at);

            if($lastDate != date("Y.m.d", $dateToTimestamp)){
                $year = date('Y', $dateToTimestamp);
                $month = date('m', $dateToTimestamp);
                $date = date('d', $dateToTimestamp);

                $today = date('Y.m.d');
                $yesterday = date('Y.m.d',strtotime("-1 days"));
                $dateToBeChecked = date('Y.m.d', $dateToTimestamp);
                if($today == $dateToBeChecked){
                    $objectElement = __('Today');
                }else if($yesterday == $dateToBeChecked){
                    $objectElement = __('Yesterday');
                }else{
                    $objectElement = $date.' '.$MonthNames[(int)$month-1].' '.$year;
                }

                $logsGroupedByDate->$objectElement = [];

                //Set array key to null
                $key=0;

                //Set new last date
                $lastDate = date("Y.m.d", $dateToTimestamp);
            }

            $logsGroupedByDate->$objectElement[$key] = $value;

            //Customize/Save user action time
            $time = date('G:i', $dateToTimestamp);
            $logsGroupedByDate->$objectElement[$key]->time = $time;

            $key++;
        }

        return view('adminlte.user_admin.user-profile',compact(['userInfo', 'logsGroupedByDate']));
    }
}
