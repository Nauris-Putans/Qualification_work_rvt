<?php

namespace App\Http\Controllers\Adminlte\user_admin\monitoring;

use App\Models\Adminlte\user_admin\Monitoring\MonitoringUptime;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Becker\Zabbix\ZabbixApi;
use Becker\Zabbix\ZabbixException;
use Illuminate\Support\Facades\DB;

class MonitoringUptimeController extends Controller
{
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
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index(Request $request)
    {
        $currentUserID = $request->session()->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");//Get current user ID;
        $usergroupID = DB::table('monitoring_users_groups')->where('group_admin_id', $currentUserID)->get('group_id')->first();//Get current user Group;
        if($usergroupID != null){
            $usergroupID = $usergroupID->group_id;
        }
        $itemid = DB::table('monitoring_monitors')->join('monitoring_items', 'monitoring_monitors.item', '=', 'monitoring_items.item_id')->where('user_group', $usergroupID)->where('check_type', 2)->get('item');//Get items;

        $itemsFriendlyName = DB::table('monitoring_monitors')->join('monitoring_items', 'monitoring_monitors.item', '=', 'monitoring_items.item_id')->where('user_group', $usergroupID)->where('check_type', 2)->get('friendly_name');//Get items friendly names;

        if($itemid != null){
            $itemid = $itemid[0]->item;
        }else{
            dd('You dont have any item');
        }


        date_default_timezone_set("Europe/Riga");
        $yesterday  = mktime(0, 0, 0, date("m"), date("d")-1, date("Y"));

        $histories = $this->zabbix->historyGet([
            'output' => 'extend',
            'sortorder' => 'DESC',
            'itemids' => $itemid,
        ]);

        return view('adminlte.user_admin.monitoring.uptime', compact(['histories','itemsFriendlyName']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * 
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $currentUserID = $request->session()->get("login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d");//Get current user ID;
        $usergroupID = DB::table('monitoring_users_groups')->where('group_admin_id', $currentUserID)->get('group_id')->first();//Get current user Group;
        if($usergroupID != null){
            $usergroupID = $usergroupID->group_id;
        }
        $itemid = DB::table('monitoring_monitors')->join('monitoring_items', 'monitoring_monitors.item', '=', 'monitoring_items.item_id')->where('user_group', $usergroupID)->where('check_type', 2)->where('friendly_name', $request->item_name)->get('item');//Get items;
        $itemsFriendlyName = DB::table('monitoring_monitors')->join('monitoring_items', 'monitoring_monitors.item', '=', 'monitoring_items.item_id')->where('user_group', $usergroupID)->where('check_type', 2)->get('friendly_name');//Get items friendly names;
        if($itemid != null){
            foreach ($itemid as $value){
                $itemid = $value->item;
            }
        }else{
            dd('You dont have any item');
        }

        $histories = $this->zabbix->historyGet([
            'output' => 'extend',
            'sortorder' => 'DESC',
            'itemids' => $itemid,
        ]);

        return compact(['histories','itemsFriendlyName']);
    }

    /**
     * Display the specified resource.
     *
     * @param MonitoringUptime $monitoringUptime
     * @return Response
     */
    public function show(MonitoringUptime $monitoringUptime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param MonitoringUptime $monitoringUptime
     * @return Response
     */
    public function edit(MonitoringUptime $monitoringUptime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param MonitoringUptime $monitoringUptime
     * @return Response
     */
    public function update(Request $request, MonitoringUptime $monitoringUptime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MonitoringUptime $monitoringUptime
     * @return Response
     */
    public function destroy(MonitoringUptime $monitoringUptime)
    {
        //
    }
}
