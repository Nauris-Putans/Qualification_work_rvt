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

        $webScenarios = [
            [
                "httptest_id" => "25",
                "httptest_name" => "www.google.lv check"
            ],
            [
                "httptest_id" => "26",
                "httptest_name" => "www.uzdevumi.lv check"
            ],
            [
                "httptest_id" => "27",
                "httptest_name" => "www.rvt.lv check"
            ],
            [
                "httptest_id" => "28",
                "httptest_name" => "www.youtube.com check"
            ],
            [
                "httptest_id" => "29",
                "httptest_name" => "www.web.whatsapp.com check"
            ],
            [
                "httptest_id" => "31",
                "httptest_name" => "w3schools.com check"
            ],
            
        ];


        $aplications = [
            [
                "application_id" => "1429",
                "application_name" => "SimpleCheck"
            ],
            [
                "application_id" => "1430",
                "application_name" => "SimpleCheck"
            ],
            [
                "application_id" => "1435",
                "application_name" => "SimpleCheck"
            ],
            [
                "application_id" => "1436",
                "application_name" => "SimpleCheck"
            ],
            [
                "application_id" => "1437",
                "application_name" => "SimpleCheck"
            ],
            [
                "application_id" => "1438",
                "application_name" => "SimpleCheck"
            ],
            [
                "application_id" => "1440",
                "application_name" => "SimpleCheck"
            ],
            
        ];

        $monitoringUsersGroups = [
            [
                "group_id" => "G1",
                "group_admin_id" => "1",
                "group_name" => 'Chill'
            ],
        ];

        $monitoringGroupMembers = [
            [
                "group_id" => "G1",
                "group_member" => "1",
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
            [
                "host_id" => "10437",
                "host_name" => "G1 www.google.lv",
                "check_address" => 'www.google.lv',
                "host_group" => '89'
            ],
            [
                "host_id" => "10438",
                "host_name" => "G1 www.uzdevumi.lv",
                "check_address" => 'www.uzdevumi.lv',
                "host_group" => '89'
            ],
            [
                "host_id" => "10443",
                "host_name" => "G1 www.rvt.lv",
                "check_address" => 'www.rvt.lv',
                "host_group" => '89'
            ],
            [
                "host_id" => "10444",
                "host_name" => "G1 8.8.8.8",
                "check_address" => '8.8.8.8',
                "host_group" => '89'
            ],
            [
                "host_id" => "10445",
                "host_name" => "G1 www.youtube.com",
                "check_address" => 'www.youtube.com',
                "host_group" => '89'
            ],
            [
                "host_id" => "10446",
                "host_name" => "G1 www.web.whatsapp.com",
                "check_address" => 'www.web.whatsapp.com',
                "host_group" => '89'
            ],
            [
                "host_id" => "10449",
                "host_name" => "G1 www.w3shools.com",
                "check_address" => 'www.w3shools.com',
                "host_group" => '89'
            ]
        ];

        $hostHasWebScenario = [
            [
                "web_scenario" => "25",
                "host_id" => "10437"
            ],
            [
                "web_scenario" => "26",
                "host_id" => "10438"
            ],
            [
                "web_scenario" => "27",
                "host_id" => "10443"
            ],
            [
                "web_scenario" => "28",
                "host_id" => "10445"
            ],
            [
                "web_scenario" => "29",
                "host_id" => "10446"
            ],
            [
                "web_scenario" => "31",
                "host_id" => "10449"
            ]
        ];

        $hostHasApplication = [
            [
                "host_id" => "10437",
                "application" => "1429"
            ],
            [
                "host_id" => "10438",
                "application" => "1430"
            ],
            [
                "host_id" => "10443",
                "application" => "1435"
            ],
            [
                "host_id" => "10444",
                "application" => "1436"
            ],
            [
                "host_id" => "10445",
                "application" => "1437"
            ],
            [
                "host_id" => "10446",
                "application" => "1438"
            ],
            [
                "host_id" => "10449",
                "application" => "1440"
            ],
        ];

        $monitoringItems = [
            [
                "item_id" => "31750",
                "check_address" => "https://www.google.lv",
                "check_type" => "3",
                "application" => "1430"
            ],
            [
                "item_id" => "31751",
                "check_address" => "https://www.google.lv",
                "check_type" => "1",
                "application" => "1430"
            ],
            [
                "item_id" => "31752",
                "check_address" => "https://www.google.lv",
                "check_type" => "2",
                "application" => "1430"
            ],
            [
                "item_id" => "31756",
                "check_address" => "https://www.uzdevumi.lv",
                "check_type" => "3",
                "application" => "1430"
            ],
            [
                "item_id" => "31757",
                "check_address" => "https://www.uzdevumi.lv",
                "check_type" => "1",
                "application" => "1430"
            ],
            [
                "item_id" => "31758",
                "check_address" => "https://www.uzdevumi.lv",
                "check_type" => "2",
                "application" => "1430"
            ],
            [
                "item_id" => "31770",
                "check_address" => "https://www.rvt.lv",
                "check_type" => "3",
                "application" => "1435"
            ],
            [
                "item_id" => "31771",
                "check_address" => "https://www.rvt.lv",
                "check_type" => "1",
                "application" => "1435"
            ],
            [
                "item_id" => "31772",
                "check_address" => "https://www.rvt.lv",
                "check_type" => "2",
                "application" => "1435"
            ],
            [
                "item_id" => "31773",
                "check_address" => "8.8.8.8",
                "check_type" => "1",
                "application" => "1436"
            ],
            [
                "item_id" => "31774",
                "check_address" => "8.8.8.8",
                "check_type" => "2",
                "application" => "1436"
            ],
            [
                "item_id" => "31778",
                "check_address" => "https://www.youtube.com",
                "check_type" => "3",
                "application" => "1437"
            ],
            [
                "item_id" => "31779",
                "check_address" => "https://www.youtube.com",
                "check_type" => "1",
                "application" => "1437"
            ],
            [
                "item_id" => "31780",
                "check_address" => "https://www.youtube.com",
                "check_type" => "2",
                "application" => "1437"
            ],
            [
                "item_id" => "31784",
                "check_address" => "https://web.whatsap.com",
                "check_type" => "3",
                "application" => "1429"
            ],
            [
                "item_id" => "31785",
                "check_address" => "https://web.whatsap.com",
                "check_type" => "1",
                "application" => "1429"
            ],
            [
                "item_id" => "31786",
                "check_address" => "https://web.whatsap.com",
                "check_type" => "2",
                "application" => "1429"
            ],
            [
                "item_id" => "31798",
                "check_address" => "https://www.w3schools.com",
                "check_type" => "3",
                "application" => "1440"
            ],
            [
                "item_id" => "31799",
                "check_address" => "https://www.w3schools.com",
                "check_type" => "1",
                "application" => "1440"
            ],
            [
                "item_id" => "31800",
                "check_address" => "https://www.w3schools.com",
                "check_type" => "2",
                "application" => "1440"
            ],
        ];

        $monitoringMonitors = [
            [
                "id" => "6",
                "friendly_name" => "GOOGLE",
                "user_group" => "G1",
                "user_id" => "1",
                "item" => "31750",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => "7",
                "friendly_name" => "GOOGLE",
                "user_group" => "G1",
                "user_id" => "1",
                "item" => "31751",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => "8",
                "friendly_name" => "GOOGLE",
                "user_group" => "G1",
                "user_id" => "1",
                "item" => "31752",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => "12",
                "friendly_name" => "Ping",
                "user_group" => "G1",
                "user_id" => "1",
                "item" => "31773",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => "13",
                "friendly_name" => "Ping",
                "user_group" => "G1",
                "user_id" => "1",
                "item" => "31774",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => "3",
                "friendly_name" => "RVT",
                "user_group" => "G1",
                "user_id" => "1",
                "item" => "31770",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => "4",
                "friendly_name" => "RVT",
                "user_group" => "G1",
                "user_id" => "1",
                "item" => "31771",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => "5",
                "friendly_name" => "RVT",
                "user_group" => "G1",
                "user_id" => "1",
                "item" => "31772",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => "9",
                "friendly_name" => "Uzdevumi",
                "user_group" => "G1",
                "user_id" => "1",
                "item" => "31756",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => "10",
                "friendly_name" => "Uzdevumi",
                "user_group" => "G1",
                "user_id" => "1",
                "item" => "31757",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => "11",
                "friendly_name" => "Uzdevumi",
                "user_group" => "G1",
                "user_id" => "1",
                "item" => "31758",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => "17",
                "friendly_name" => "WhatsApp",
                "user_group" => "G1",
                "user_id" => "1",
                "item" => "31784",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => "18",
                "friendly_name" => "WhatsApp",
                "user_group" => "G1",
                "user_id" => "1",
                "item" => "31785",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => "19",
                "friendly_name" => "WhatsApp",
                "user_group" => "G1",
                "user_id" => "1",
                "item" => "31786",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => "20",
                "friendly_name" => "www.w3school.com",
                "user_group" => "G1",
                "user_id" => "1",
                "item" => "31798",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => "21",
                "friendly_name" => "www.w3school.com",
                "user_group" => "G1",
                "user_id" => "1",
                "item" => "31799",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => "22",
                "friendly_name" => "www.w3school.com",
                "user_group" => "G1",
                "user_id" => "1",
                "item" => "31800",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => "14",
                "friendly_name" => "youtube",
                "user_group" => "G1",
                "user_id" => "1",
                "item" => "31778",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => "15",
                "friendly_name" => "youtube",
                "user_group" => "G1",
                "user_id" => "1",
                "item" => "31779",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "id" => "16",
                "friendly_name" => "youtube",
                "user_group" => "G1",
                "user_id" => "1",
                "item" => "31780",
                "created_at" => now(),
                "updated_at" => now()
            ]
        ];

        DB::table('monitoring_check_types')->insert($checkTypes);
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
