<?php

namespace App\Http\Controllers\Adminlte\user_admin\monitoring\monitors;

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
    public function create()
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
        //Get element from array
        // if($request->Persons != null){
        //     foreach ($request->Persons as $person_item) {
        //         echo $person_item["Name"];
        //     }
        // }

        //Create host group
        $newHostGroup = $this->zabbix->hostgroupCreate([
            "name" => "TestGroupLarave2"
        ]);


        //Create HOST
        $newHost = $this->zabbix->hostCreate([
            "host" => "Test Host2",
            "interfaces" => [
                [
                    "type"=> 1,
                    "main"=> 1,
                    "useip"=> 1,
                    "ip"=> "8.8.8.8",
                    "dns"=> "",
                    "port"=> "10050"
                ]
            ],
            "groups" => [
                [
                    "groupid" => $newHostGroup->groupids[0]
                ]
            ]
        ]);

        //Create application
        $newApplication = $this->zabbix->applicationCreate([
            "name"=> "Auto created application2", //New application name
            "hostid"=> $newHost->hostids[0] 
        ]);

        //Host interface get
        $hostInterfaceID=$this->zabbix->hostinterfaceGet([
            "hostids" => $newHost->hostids[0]
        ]);

        //Create items 
        $ItemCreate = $this->zabbix->itemCreate([
            "name"=> "AutoCreatedItem2",  //Item name
            "key_"=> "icmppingsec",  //what to check
            "hostid"=> $newHost->hostids[0],  //Host ID
            "type"=> 3, //Simple check
            "value_type"=> 0, //Numeric float
            "interfaceid"=> $hostInterfaceID[0]->interfaceid,
            "applications"=> [
                $newApplication->applicationids[0] //ApplicationID
            ],
            "delay"=> "30s"   //check time
        ]);

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
