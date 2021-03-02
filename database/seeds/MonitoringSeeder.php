<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonitoringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $checkTypes = [
            [
                "id" => "1",
                "check_type_name" => "Response speed"
            ],
            [
                "id" => "2",
                "check_type_name" => "Uptime"
            ],
            [
                "id" => "3",
                "check_type_name" => "Download speed"
            ]
        ];

        $monitor_type = [
            [
                'monitor_type_id' => '1',
                'monitor_type' => 'ping'
            ],
            [
                'monitor_type_id' => '2',
                'monitor_type' => 'url'
            ],
            [
                'monitor_type_id' => '3',
                'monitor_type' => 'dns'
            ],
        ];

        $monitorStatus = [
            [
                "status_id" => "1",
                "status_name" => "Enabled"
            ],
            [
                "status_id" => "2",
                "status_name" => "Disabled"
            ]
        ];

        $webScenarios = [
            // [
            //     "httptest_id" => "25",
            //     "httptest_name" => "www.google.lv check"
            // ],
            
        ];


        $aplications = [
            // [
            //     "application_id" => "1429",
            //     "application_name" => "SimpleCheck"
            // ],
            
        ];

        $monitoringUsersGroups = [
            [
                "group_id" => "G1",
                "group_admin_id" => "1",
                "group_name" => 'Chill'
            ],
            [
                "group_id" => "G2",
                "group_admin_id" => "2",
                "group_name" => 'pro group'
            ],
            [
                "group_id" => "G3",
                "group_admin_id" => "3",
                "group_name" => 'webMaster group'
            ],
            [
                "group_id" => "G4",
                "group_admin_id" => "4",
                "group_name" => 'admin group'
            ],
        ];

        $monitoringGroupMembers = [
            [
                "group_id" => "G1",
                "group_member" => "1",
                "group_member_permission" => '1'
            ],
            [
                "group_id" => "G2",
                "group_member" => "2",
                "group_member_permission" => '1'
            ],
            [
                "group_id" => "G3",
                "group_member" => "3",
                "group_member_permission" => '1'
            ],
            [
                "group_id" => "G4",
                "group_member" => "4",
                "group_member_permission" => '1'
            ],
        ];

        $monitoringHostsGroups = [
            [
                "host_group_id" => "89",
                "host_group_name" => "G1-Hosts",
                "user_group" => 'G1'
            ],
        ];

        $monitoringHosts = [
            // [
            //     "host_id" => "10437",
            //     "host_name" => "G1 www.google.lv",
            //     "check_address" => 'www.google.lv',
            //     "host_group" => '89'
            // ],
        ];

        $hostHasWebScenario = [
            // [
            //     "web_scenario" => "25",
            //     "host_id" => "10437"
            // ],
        ];

        $hostHasApplication = [
            // [
            //     "host_id" => "10437",
            //     "application" => "1429"
            // ],
        ];

        $monitoringItems = [
            // [
            //     "item_id" => "31750",
            //     "check_address" => "https://www.google.lv",
            //     "check_type" => "3",
            //     "application" => "1430"
            // ],
        ];

        $monitoringMonitors = [
            // [
            //     "id" => "6",
            //     "friendly_name" => "GOOGLE",
            //     "user_group" => "G1",
            //     "user_id" => "1",
            //     "item" => "31750",
            //     "status" => "1",
            //     "created_at" => now(),
            //     "updated_at" => now()
            // ],
        ];

        $dashboardItemsTypes = [
            [
                "item_type_id" => "1",
                "item_type_name" => "current status chart",
            ],
            [
                "item_type_id" => "2",
                "item_type_name" => "area chart",
            ],
        ];
        DB::table('monitoring_user_dashboard_item_types')->insert($dashboardItemsTypes);

        DB::table('monitoring_check_types')->insert($checkTypes);
        DB::table('monitoring_monitor_type')->insert($monitor_type);
        DB::table('monitoring_status')->insert($monitorStatus);
        DB::table('web_scenarios')->insert($webScenarios);
        DB::table('monitoring_applications')->insert($aplications);
        DB::table('monitoring_users_groups')->insert($monitoringUsersGroups);
        DB::table('monitoring_hosts_groups')->insert($monitoringHostsGroups);
        DB::table('monitoring_group_members')->insert($monitoringGroupMembers);
        DB::table('monitoring_hosts')->insert($monitoringHosts);
        DB::table('host_has_web_scenario')->insert($hostHasWebScenario);
        DB::table('host_has_application')->insert($hostHasApplication);
        DB::table('monitoring_items')->insert($monitoringItems);
        DB::table('monitoring_monitors')->insert($monitoringMonitors);
    }
}
