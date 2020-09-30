<?php

namespace App\Http\Controllers;

use Becker\Zabbix\ZabbixApi;

class TestController extends Controller
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
     * Get all the Zabbix host groups.
     *
     */
    public function index()
    {
        return collect($this->zabbix->hostgroupGet())->map(function ($item) {
            return [
                'name' => strtoupper($item->name)
            ];
        });
    }
}
