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

// Role - Admin
Route::group(['middleware' => ['role:admin']], function()
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
    Route::get('/admin/tickets', 'Adminlte\admin\TicketController@index');
    Route::get('/admin/tickets/{id}', 'Adminlte\admin\TicketController@profile');

    // Settings section
    Route::get('/admin/settings', 'Adminlte\admin\SettingsAdminController@show');
    Route::patch('/admin/settings/personal_info/{id}', ['as' => 'admin.settings.personal_info.update', 'uses' => 'Adminlte\admin\SettingsAdminController@personal_info_update']);
    Route::patch('/admin/settings/password_security/{id}', ['as' => 'admin.settings.password_security.update', 'uses' => 'Adminlte\admin\SettingsAdminController@password_security_update']);
    Route::post('/admin/settings/profile_image/update', 'Adminlte\admin\SettingsAdminController@updateProfile');

    // This link will add session of language when they click to change language
    Route::get('admin/lang/{locale}', 'LocalizationController@index');
    Route::get('admin/users/lang/{locale}', 'LocalizationController@index');
    Route::get('admin/team/lang/{locale}', 'LocalizationController@index');
    Route::get('admin/team/members/lang/{locale}', 'LocalizationController@index');
    Route::get('/admin/roles/lang/{locale}', 'LocalizationController@index');
    Route::get('/admin/roles/../lang/{locale}', 'LocalizationController@index');
    Route::get('/admin/tickets/lang/{locale}', 'LocalizationController@index');
});

// Role - User Admin (free)
Route::group(['middleware' => ['role:userFree|userPro|userWebmaster']], function()
{
    // Dashboard section
    Route::get('/user/dashboard', 'Adminlte\ZabbixController@historyGet')->name('admin.user_admin.index');

    // Monitoring sections
    Route::get('/user/monitoring/monitors/add', 'Adminlte\user_admin\monitoring\monitors\MonitoringMonitorsController@create');
    Route::post('/user/monitoring/monitors/add', 'Adminlte\user_admin\monitoring\monitors\MonitoringMonitorsController@store');
    Route::get('/user/monitoring/monitors/list', 'Adminlte\user_admin\monitoring\monitors\MonitoringMonitorsController@history');
    Route::get('/user/monitoring/uptime', 'Adminlte\user_admin\monitoring\MonitoringUptimeController@index');
    Route::get('/user/monitoring/page-speed', 'Adminlte\user_admin\monitoring\MonitoringPageSpeedController@index');
    Route::get('/user/monitoring/real-user-monitoring', 'Adminlte\user_admin\monitoring\MonitoringRealUserMonitoringController@index');

    // Alerts sections
    Route::get('/user/alerts', 'Adminlte\user_admin\AlertsController@index');

    // Settings section
    Route::get('/user/settings', 'Adminlte\user_admin\SettingController@index');

    // Support section
    Route::get('/user/support', 'Adminlte\user_admin\SupportController@index');

    // This link will add session of language when they click to change language
    Route::get('user/lang/{locale}', 'LocalizationController@index');
});

// This link will add session of language when they click to change language
Route::get('lang/{locale}', 'LocalizationController@index');
