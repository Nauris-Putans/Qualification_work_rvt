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
    Route::get('/monitoring/monitors/add', 'Adminlte\MonitorController@store');
    Route::get('/monitoring/monitors/history', 'Adminlte\MonitorController@history');
    Route::get('/monitoring/uptime', 'Adminlte\MonitorController@uptime');
    Route::get('/monitoring/page-speed', 'Adminlte\MonitorController@pageSpeed');
    Route::get('/monitoring/transaction', 'Adminlte\MonitorController@transaction');
    Route::get('/monitoring/real-user-monitoring', 'Adminlte\MonitorController@realUserMonitoring');

    // Reports sections
    Route::get('/reports/uptime', 'Adminlte\ReportController@uptime');
    Route::get('/reports/page-speed', 'Adminlte\ReportController@pageSpeed');
    Route::get('/reports/transaction', 'Adminlte\ReportController@transaction');
    Route::get('/reports/real-user-monitoring', 'Adminlte\ReportController@realUserMonitoring');

    // Alerts sections
    Route::get('/alerts/list', 'Adminlte\AlertController@list');
    Route::get('/alerts/on-call', 'Adminlte\AlertController@onCall');

    // Settings section
    Route::get('/settings', 'Adminlte\SettingController@index');

    // Support section
    Route::get('/support', 'Adminlte\SupportController@index');
});
