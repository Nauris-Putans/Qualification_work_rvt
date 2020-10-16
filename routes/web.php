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
Route::get('/', 'Pages\HomeController@index');

// Features section
Route::get('/features', 'Pages\FeaturesController@index');

// Pricing section
Route::get('/pricing', 'Pages\PricingController@index');

// FAQ section
Route::get('/faq', 'Pages\FAQController@index');

// Contacts sections
Route::get('/contacts', 'Pages\ContactController@index');
Route::post('/contacts/create', 'Pages\ContactController@store');

/*
|--------------------------------------------------------------------------
| Adminlte
|--------------------------------------------------------------------------
*/

// Role - Admin
Route::group(['middleware' => ['role:admin']], function()
{
    // Roles sections
    Route::get('/admin/add-role', 'Adminlte\admin\RoleController@index');
    Route::post('/admin/add-role', 'Adminlte\admin\RoleController@store');

    Route::get('/admin/assign-role', 'Adminlte\admin\RoleAssignmentController@index');
    Route::post('/admin/assign-role', 'Adminlte\admin\RoleAssignmentController@store');

    // Permission sections
    Route::get('/admin/add-permission', 'Adminlte\admin\PermissionController@index');
    Route::post('/admin/add-permission', 'Adminlte\admin\PermissionController@store');

    Route::get('/admin/assign-permission', 'Adminlte\admin\PermissionAssignmentController@index');
    Route::post('/admin/assign-permission', 'Adminlte\admin\PermissionAssignmentController@store');
});

// Role - User Admin (free)
Route::group(['middleware' => ['role:userFree|userPro']], function()
{
    // Dashboard section
    Route::get('/dashboard', 'Adminlte\ZabbixController@historyGet')->name('admin.user_admin.index');

    // Monitoring sections
    Route::get('/monitoring/monitors/add', 'Adminlte\user_admin\Monitoring\Monitors\MonitoringMonitorsController@create');
    Route::post('/monitoring/monitors/add', 'Adminlte\user_admin\Monitoring\Monitors\MonitoringMonitorsController@store');
    Route::get('/monitoring/monitors/history', 'Adminlte\user_admin\Monitoring\Monitors\MonitoringMonitorsController@history');
    Route::get('/monitoring/uptime', 'Adminlte\user_admin\Monitoring\MonitoringUptimeController@index');
    Route::get('/monitoring/page-speed', 'Adminlte\user_admin\Monitoring\MonitoringPageSpeedController@index');
    Route::get('/monitoring/transaction', 'Adminlte\user_admin\Monitoring\MonitoringTransactionController@index');
    Route::get('/monitoring/real-user-monitoring', 'Adminlte\user_admin\Monitoring\MonitoringRealUserMonitoringController@index');

    // Reports sections
    Route::get('/reports/uptime', 'Adminlte\user_admin\Reports\ReportUptimeController@index');
    Route::get('/reports/page-speed', 'Adminlte\user_admin\Reports\ReportPageSpeedController@index');
    Route::get('/reports/transaction', 'Adminlte\user_admin\Reports\ReportTransactionController@index');
    Route::get('/reports/real-user-monitoring', 'Adminlte\user_admin\Reports\ReportRealUserMonitoringController@index');

    // Alerts sections
    Route::get('/alerts/list', 'Adminlte\user_admin\Alerts\AlertListController@index');
    Route::get('/alerts/on-call', 'Adminlte\user_admin\Alerts\AlertOnCallController@index');

    // Settings section
    Route::get('/settings', 'Adminlte\user_admin\SettingController@index');

    // Support section
    Route::get('/support', 'Adminlte\user_admin\SupportController@index');
});
