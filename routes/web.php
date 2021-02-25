<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

// Home section
Route::get('/', 'Pages\HomeController@index')->name('home');

// Features section
Route::get('/features', 'Pages\FeaturesController@index')->name('features');

// Pricing section
Route::get('/pricing', 'Pages\PricingController@index')->name('pricing');

// FAQ section
Route::get('/faq', 'Pages\FAQController@index')->name('faq');

// Contacts sections
Route::get('/contacts', 'Pages\ContactController@index')->name('contacts');
Route::post('/contacts/create', 'Pages\ContactController@store')->name('contacts.create');
/*
|--------------------------------------------------------------------------
| Adminlte
|--------------------------------------------------------------------------
*/

$adminSide = 'admin|member|developer|maintainer';
$userAdminSide = 'userFree|userPro|userWebmaster';

// Role - Admin
Route::middleware(['role:' . $adminSide])->group( function()
{
    // Dashboard section
    Route::get('/admin/dashboard', 'Adminlte\admin\DashboardAdminController@index');

    // Users sections
    Route::get('/admin/users', 'Adminlte\admin\UsersAdminController@index');

    // Profile section
    Route::get('/admin/users/{id}', 'Adminlte\admin\ProfileAdminController@index');
    Route::get('/admin/team/members/{id}', 'Adminlte\admin\ProfileAdminController@index');

    // Team Members sections
    Route::get('/admin/team/members', 'Adminlte\admin\team\MembersController@index');

    Route::get('/admin/roles', ['as' => 'admin.roles.index', 'uses' => 'Adminlte\admin\team\privileges\roles\RoleController@index']);
    Route::get('/admin/roles/create', ['as' => 'admin.roles.create', 'uses' => 'Adminlte\admin\team\privileges\roles\RoleController@create']);
    Route::post('/admin/roles', ['as' => 'admin.roles.store', 'uses' => 'Adminlte\admin\team\privileges\roles\RoleController@store']);
    Route::get('/admin/roles/{role}', ['as' => 'admin.roles.show', 'uses' => 'Adminlte\admin\team\privileges\roles\RoleController@show']);
    Route::get('/admin/roles/{role}/edit', ['as' => 'admin.roles.edit', 'uses' => 'Adminlte\admin\team\privileges\roles\RoleController@edit']);
    Route::patch('/admin/roles/{role}', ['as' => 'admin.roles.update', 'uses' => 'Adminlte\admin\team\privileges\roles\RoleController@update']);
    Route::delete('/admin/roles/{role}', ['as' => 'admin.roles.destroy', 'uses' => 'Adminlte\admin\team\privileges\roles\RoleController@destroy']);

    Route::get('/admin/assign-role', 'Adminlte\admin\team\privileges\roles\RoleAssignmentController@index');
    Route::post('/admin/assign-role', ['as' => 'admin.assign-role.store', 'uses' => 'Adminlte\admin\team\privileges\roles\RoleAssignmentController@store']);
    Route::get('/admin/add-permission', 'Adminlte\admin\team\privileges\permissions\PermissionController@index');
    Route::post('/admin/add-permission', 'Adminlte\admin\team\privileges\permissions\PermissionController@store');
    Route::get('/admin/assign-permission', 'Adminlte\admin\team\privileges\permissions\PermissionAssignmentController@index');
    Route::post('/admin/assign-permission', 'Adminlte\admin\team\privileges\permissions\PermissionAssignmentController@store');

    // Tickets section
    Route::get('/admin/tickets', 'TicketController@index');
    Route::get('/admin/tickets/{id}', 'TicketController@show');
    Route::delete('/admin/tickets/{id}', ['as' => 'admin.tickets.destroy', 'uses' => 'TicketController@destroy']);
    Route::post('/admin/tickets/close_ticket/{id}', 'TicketController@close');
    Route::post('/admin/tickets/{ticket_id}/comment', 'CommentsController@postComment');

    // Settings section
    Route::get('/admin/settings', 'Adminlte\admin\SettingsAdminController@show');
    Route::patch('/admin/settings/personal_info/{id}', ['as' => 'admin.settings.personal_info.update', 'uses' => 'Adminlte\admin\SettingsAdminController@personal_info_update']);
    Route::patch('/admin/settings/notification/{id}', ['as' => 'admin.settings.notification.update', 'uses' => 'Adminlte\admin\SettingsAdminController@notification_update']);
    Route::patch('/admin/settings/password_security/{id}', ['as' => 'admin.settings.password_security.update', 'uses' => 'Adminlte\admin\SettingsAdminController@password_security_update']);
    Route::post('/admin/settings/profile_image/update', 'Adminlte\admin\SettingsAdminController@updateProfile');

    // This link will add session of language when they click to change language
    Route::get('admin/lang/{locale}', 'LocalizationController@index');
});

// Role - User Admin (free)
Route::middleware(['role:' . $userAdminSide])->group( function()
{
    // Dashboard section
    Route::get('/user/dashboard', 'Adminlte\ZabbixController@index')->name('admin.user_admin.index');
    Route::post('/user/dashboard/newAreaChartStore', 'Adminlte\ZabbixController@newAreaChartStore')->name('user.dashboard.newAreaChartStore');
    Route::post('/user/dashboard/lastStatusGet', 'Adminlte\ZabbixController@lastStatusHistoryGet')->name('user.dashboard.lastStatusHistoryGet');
    Route::post('/user/dashboard/removeItem', 'Adminlte\ZabbixController@itemRemove')->name('user.dashboard.itemRemove');

    // Monitoring sections
    Route::get('/user/monitoring/monitors/add', 'Adminlte\user_admin\monitoring\monitors\MonitoringMonitorsController@create');
    Route::post('/user/monitoring/monitors/add', 'Adminlte\user_admin\monitoring\monitors\MonitoringMonitorsController@store')->name('add.store');
    Route::get('/user/monitoring/monitors/list', 'Adminlte\user_admin\monitoring\monitors\MonitoringMonitorsListController@index');
    Route::post('/user/monitoring/monitors/list/delete/{monitorId}', 'Adminlte\user_admin\monitoring\monitors\MonitoringMonitorsListController@deleteMonitor')->name('monitor.destroy');
    Route::post('/user/monitoring/monitors/list/change-status/{monitorId}', 'Adminlte\user_admin\monitoring\monitors\MonitoringMonitorsListController@changeStatus')->name('monitor.changeStatus');
    Route::get('/user/monitoring/uptime', 'Adminlte\user_admin\monitoring\MonitoringUptimeController@index');
    Route::post('/user/monitoring/uptime', 'Adminlte\user_admin\monitoring\MonitoringUptimeController@store');
    Route::get('/user/monitoring/page-speed', 'Adminlte\user_admin\monitoring\MonitoringPageSpeedController@index');
    Route::post('/user/monitoring/page-speed', 'Adminlte\user_admin\monitoring\MonitoringPageSpeedController@store');
    Route::get('/user/monitoring/real-user-monitoring', 'Adminlte\user_admin\monitoring\MonitoringRealUserMonitoringController@index');
    Route::post('/user/monitoring/real-user-monitoring', 'Adminlte\user_admin\monitoring\MonitoringRealUserMonitoringController@store');
    // Alerts sections
    Route::get('/user/alerts', 'Adminlte\user_admin\AlertsController@index');

    // Settings section
    Route::get('/user/settings', 'Adminlte\user_admin\SettingController@index');
    Route::post('/user/settings', 'Adminlte\user_admin\SettingController@personal_info');
    // Route::post('/user/settings/password_security', 'Adminlte\user_admin\SettingController@password_security');

    // Tickets section
    Route::get('/user/support/tickets', ['as' => 'user.support.tickets', 'uses' => 'TicketController@userTickets']);
    Route::get('/user/support/tickets/create', ['as' => 'user.support.tickets.create', 'uses' => 'TicketController@userCreateTicket']);
    Route::post('/user/support/tickets/create', ['as' => 'user.support.tickets.create', 'uses' => 'TicketController@userStoreTicket']);
    Route::get('/user/support/tickets/{ticket_id}', ['as' => 'user.support.ticket', 'uses' => 'TicketController@userShowTicket']);
    Route::post('/user/support/tickets/{ticket_id}/comment', 'CommentsController@postComment');

    // This link will add session of language when they click to change language
    Route::get('user/lang/{locale}', 'LocalizationController@index');
});

// This link will add session of language when they click to change language
Route::get('lang/{locale}', 'LocalizationController@index');
