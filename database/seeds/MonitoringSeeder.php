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
            ],
            [
                "status_id" => "3",
                "status_name" => "No alert"
            ]
        ];

        $webScenarios = [
            [
                "httptest_id" => "205",
                "httptest_name" => "nytimes.com check"
            ],
            
        ];


        $aplications = [
            [
                "application_id" => "1696",
                "application_name" => "Web check"
            ],  
        ];

        $chartType = [
            [
                "chartTypeId" => 1,
                "chart_type" => "line"
            ],
            [
                "chartTypeId" => 2,
                "chart_type" => "bar"
            ]
        ];

        $users = [
            [
                "id" => "32",
                "name" => "Rolands Bidzāns",
                "email" => 'rolandone@inbox.lv',
                "profile_image" => "/storage/uploads/profile_images/rolands-bidzans_1615569032.jpg",
                "password" => '$2y$10$WPePnHRZmbwPKBLxh/kukeKZLD4btDNgKh0U18Af2U5/n7z6HsJtG',
                "phone_number" => "+37422222322",
                "country" => "8",
                "city" => 'Rīga',
                "gender" => "Female",
                "birthday" => "2001-08-31",
                "created_at" => "2021-03-01 17:32:03",
                "updated_at" => '2021-03-12 19:10:54',
            ],
            [
                "id" => "33",
                "name" => "Rolands Jevlejevs",
                "email" => 'rolandsnorigas@gmail.com',
                "profile_image" => "/storage/uploads/profile_images/rolands-isvyafty_1615571834.jpg",
                "password" => '$2y$10$WPePnHRZmbwPKBLxh/kukeKZLD4btDNgKh0U18Af2U5/n7z6HsJtG',
                "phone_number" => "+37422222222",
                "country" => "8",
                "city" => 'Rīga',
                "gender" => "Female",
                "birthday" => "2001-08-31",
                "created_at" => "2021-03-01 17:32:03",
                "updated_at" => '2021-03-12 19:10:54',
            ],
        ];
        DB::table('users')->insert($users);

        $userRole = [
            [
                "role_id" => "1",
                "user_id" => "32",
                "user_type" => 'App\User'
            ],
            [
                "role_id" => "1",
                "user_id" => "33",
                "user_type" => 'App\User'
            ],
        ];
        DB::table('role_user')->insert($userRole);

        $zabbixUser = [
            [
                "zabbix_user_id" => "33",
                "user_id" => "32",
                "alert-period" => "1-7,00:00-24:00"
            ],
            [
                "zabbix_user_id" => "34",
                "user_id" => "33",
                "alert-period" => "1-7,00:00-24:00"
            ],
        ];
        DB::table('monitoring_zabbix_users')->insert($zabbixUser);

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
            [
                "group_id" => "20",
                "group_admin_id" => "32",
                "group_name" => 'Rolands Bidzans group'
            ],
            [
                "group_id" => "21",
                "group_admin_id" => "33",
                "group_name" => 'Rolandš ишвяфты group'
            ],
        ];

        $userGroupMemberPermision = [
            [
                "permission_id" => 1,
                "permission_name" => "Admin"
            ],
            [
                "permission_id" => 2,
                "permission_name" => "Pre-Admin"
            ],
            [
                "permission_id" => 3,
                "permission_name" => "Read-Write"
            ],
            [
                "permission_id" => 4,
                "permission_name" => "Read"
            ],
        ];
        DB::table('group_member_permission')->insert($userGroupMemberPermision);

        $monitoringGroupMembers = [
            [
                "group_id" => "G1",
                "group_member" => "1",
                "group_member_permission" => 1
            ],
            [
                "group_id" => "G2",
                "group_member" => "2",
                "group_member_permission" => 1
            ],
            [
                "group_id" => "G3",
                "group_member" => "3",
                "group_member_permission" => 1
            ],
            [
                "group_id" => "G4",
                "group_member" => "4",
                "group_member_permission" => 1
            ],
            [
                "group_id" => "20",
                "group_member" => "32",
                "group_member_permission" => 1
            ],
            [
                "group_id" => "20",
                "group_member" => "33",
                "group_member_permission" => 3
            ],
            [
                "group_id" => "21",
                "group_member" => "33",
                "group_member_permission" => 1
            ],
        ];

        $groupRequestStatus = [
            [
                "status_id" => 1,
                "status_name" => "Requested"
            ],
            [
                "status_id" => 2,
                "status_name" => "Refused"
            ],
            [
                "status_id" => 3,
                "status_name" => "Comfirmed"
            ],
        ];
        DB::table('group_request_status')->insert($groupRequestStatus);

        $groupRequests = [
            [
                'recipient' => '33',
                'requestor' => 32,
                'group' => '20',
                'status' => 3,
                'created_at' => "2021-03-01 17:32:03"
            ]
        ];

        $monitoringHostsGroups = [
            [
                "host_group_id" => "89",
                "host_group_name" => "G1-Hosts",
                "user_group" => 'G1'
            ],
            [
                "host_group_id" => "102",
                "host_group_name" => "G32-Hosts",
                "user_group" => '20'
            ],
            [
                "host_group_id" => "103",
                "host_group_name" => "G33-Hosts",
                "user_group" => '21'
            ],
        ];

        $monitoringHosts = [
            [
                "host_id" => "10723",
                "host_name" => "20 nytimes.com 2021-03-09 16-03-52",
                "check_address" => 'https://nytimes.com',
                "host_group" => '102'
            ],
        ];

        $hostHasWebScenario = [
            [
                "web_scenario" => "205",
                'application' => 1696,
                "host_id" => "10723"
            ],
        ];


        $monitoringItems = [
            [
                "item_id" => "33002",
                "check_type" => "2",
                "application" => "1696"
            ],
            [
                "item_id" => "33004",
                "check_type" => "3",
                "application" => "1696"
            ],
            [
                "item_id" => "33005",
                "check_type" => "1",
                "application" => "1696"
            ],
        ];

        $monitoringMonitors = [
            [
                "id" => "72",
                "friendly_name" => "Ntymes",
                "user_input" => 'www.nytimes.com',
                "user_group" => "20",
                'monitor_type' => '2',
                'check_interval' => '30s',
                "user_id" => "32",
                'host' => '10723',
                "status" => "1",
                "created_at" => now(),
                "updated_at" => now()
            ],
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
            [
                "item_type_id" => "3",
                "item_type_name" => "group members list",
            ],
        ];

        $measurementUnits = [
            [
                "unit_id" => "1",
                "symbol" => "s",
            ],
            [
                "unit_id" => "2",
                "symbol" => "ms",
            ],
            [
                "unit_id" => "3",
                "symbol" => "MBps",
            ],
            [
                "unit_id" => "4",
                "symbol" => "KBps",
            ]
        ];

        $dashboardContainers = [
            [
                "container_id" => 1,
                "container_name" => 'left container'
            ],
            [
                "container_id" => 2,
                "container_name" => 'right container'
            ]
        ];

        $languages = [
            [
                "LanguageID" => 1,
                "Name" => 'English'
            ],
            [
                "LanguageID" => 2,
                "Name" => 'Latvian'
            ],
            [
                "LanguageID" => 3,
                "Name" => 'Russian'
            ]
        ];
        DB::table('languages')->insert($languages);

        $zabbixMeadiaTypes = [
            [
                "MediatypesID" => 1,
                "Name" => 'Email (EN)',
                "Language" => 1
            ],
            [
                "MediatypesID" => 4,
                "Name" => 'Email (LV)',
                "Language" => 2
            ],
            [
                "MediatypesID" => 22,
                "Name" => 'Email (RU)',
                "Language" => 3
            ],
        ];
        DB::table('zabbix_mediatypes')->insert($zabbixMeadiaTypes);

        DB::table('dashboard_container')->insert($dashboardContainers);
        DB::table('measurement_unit')->insert($measurementUnits);
        DB::table('dashboard_element_type')->insert($dashboardItemsTypes);
        DB::table('dashboard_chart_type')->insert($chartType);
        DB::table('monitoring_check_types')->insert($checkTypes);
        DB::table('monitoring_monitor_type')->insert($monitor_type);
        DB::table('monitoring_status')->insert($monitorStatus);
        DB::table('web_scenarios')->insert($webScenarios);
        DB::table('monitoring_applications')->insert($aplications);
        DB::table('monitoring_users_groups')->insert($monitoringUsersGroups);
        DB::table('monitoring_hosts_groups')->insert($monitoringHostsGroups);
        DB::table('monitoring_group_members')->insert($monitoringGroupMembers);
        DB::table('monitoring_hosts')->insert($monitoringHosts);
        DB::table('host_has_application_webscenario')->insert($hostHasWebScenario);
        DB::table('monitoring_items')->insert($monitoringItems);
        DB::table('monitoring_monitors')->insert($monitoringMonitors);
        DB::table('user_group_request')->insert($groupRequests);
    }
}
