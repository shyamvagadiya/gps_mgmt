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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();



Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index')->name('home');


Route::get('add/client','ClientController@create')->name('add.client');
Route::post('submit/client','ClientController@submit_client')->name('submit.client');
Route::get('show/client','ClientController@index')->name('show.client');


Route::get('add/vehicle','VehicleController@create')->name('add.vehicle');
Route::post('submit/vehicle','VehicleController@store')->name('submit.vehicle');
Route::get('show/vehicle','VehicleController@index')->name('show.vehicle');


Route::get('update_payment/modal','ClientController@update_payment_modal')->name('update_payment.modal');
Route::post('update/payment','ClientController@store_payment')->name('update.payment');
Route::get('show/enquiry','EnquiryController@index')->name('show.enquiry');
Route::get('add/enquiry','EnquiryController@create')->name('add.enquiry');
Route::post('submit/enquiry','EnquiryController@store')->name('submit.enquiry');

Route::get('SIM/management','ClientController@sim_management')->name('sim.management');

Route::get('complain/management','ComplainController@index')->name('complain.management');
Route::get('create/complain','ComplainController@create')->name('create.complain');
Route::get('load/data','ComplainController@load_data')->name('load_data');
Route::get('get_client/data','ComplainController@get_client_data')->name('get_client.data');
Route::post('submit/complain','ComplainController@store')->name('submit.complain');
Route::get('download_blank_excel','ClientController@downloadBlankExel')->name('download_blank_excel');
Route::get('download_blank_excel_client','ClientController@download_blank_excel_client')->name('download_blank_excel_client');

Route::post('import/data','ClientController@import_data')->name('import.data');
Route::post('import/data_client','ClientController@import_data_client')->name('import.data_client');
Route::get('download/report','ClientController@downloadReport')->name('download.report');

Route::get('logout/user','ClientController@logout')->name('logout.user');

Route::get('load_data_autofill','ClientController@load_data_autofill')->name('load_data_autofill');
Route::get('download/report_client','ExportController@client_report')->name('download.report_client');

Route::get('modify/comment/{id}','EnquiryController@modify_comment')->name('modify.comment');
Route::post('update/enquiry','EnquiryController@update')->name('update.enquiry');

Route::post('mark/resolved','ComplainController@mark_resolved')->name('mark.resolved');

Route::get('download/report_complain','ExportController@download_report_complain')->name('download.report_complain');
Route::get('download/report_sim','ExportController@download_report_sim')->name('download.report_sim');
Route::get('download/report_enquiry','ExportController@download_report_enquiry')->name('download.report_enquiry');
Route::get('edit/vehicle_status/{id}','VehicleController@edit')->name('edit.vehicle_status');
Route::post('update/vehicle_status','VehicleController@update_vehicle_status')->name('update.vehicle_status');

Route::get('inactive/sim/{id}','VehicleController@inactive_sim')->name('inactive.sim');
Route::get('active/sim/{id}','VehicleController@active_sim')->name('active.sim');

Route::post('update/remarks','ComplainController@update_remarks')->name('update.remarks');
Route::get('client/edit/{id}','ClientController@edit')->name('client.edit');
Route::post('update/client','ClientController@update')->name('update.client');

Route::get('load/prev_data','ClientController@load_prev_data')->name('load.prev_data');
