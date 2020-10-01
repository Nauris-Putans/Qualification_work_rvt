<?php

namespace App\Http\Controllers;

use Becker\Zabbix\ZabbixApi;
use Becker\Zabbix\ZabbixException;
use Illuminate\Support\Facades\Request;

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

    /**
     * Get item from zabbix
     *
     * @throws ZabbixException
     */
    public function itemGet()
    {
        $items = $this->zabbix->itemGet(['output' => 'extend','graphids' => ['1260']]);

        foreach ($items as $item)
        {
            echo "Item name - ".$item->name;
            echo "<br>";
            echo "Delay time - ".$item->delay;
            echo "<br>";
            echo "<br>";
            echo "Last value - ".$item->lastvalue;
            echo "<br>";
            echo "Previous value - ".$item->prevvalue;
        }
    }

    /**
     * Get user from zabbix
     *
     * @throws ZabbixException
     */
    public function userGet()
    {
        $user = $this->zabbix->userGet(['output' => 'extend']);

        foreach ($user as $usr) {

            echo $usr->userid."\n";
            echo $usr->alias."\n";
            echo $usr->name."\n";
            echo $usr->surname."\n";
        }
    }
}
