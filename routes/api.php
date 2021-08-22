<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => ['Apiguard']], function(){
	Route::POST('/RegAccount','Api\AppController@RegAccounts');
	Route::POST('/Details','Api\AppController@personalDetails');
	Route::POST('/Applogin','Api\AppController@appLogin');
	Route::POST('/forgotPassword','Api\AppController@forgotPassword'); 
	Route::POST('/confirmPassword','Api\AppController@confirmPassword');
	Route::POST('/updateProfile','Api\AppController@updateProfile');
	Route::POST('/setLocation','Api\AppController@SetLocation');
	Route::get('/dashboard/{id}','Api\AppController@Dashboard');
	Route::get('/doctors/{id}','Api\AppController@Doctors');
	Route::get('/doctorsDetails/{doctor_id}/{clinic_id}','Api\AppController@doctorDetails');
	Route::get('/hospitals/{id}','Api\AppController@Hospital');
	Route::get('/hospitalDetails/{id}','Api\AppController@HospitalDetails');
	Route::get('/ambulance/{id}','Api\AppController@Ambulance');
	Route::get('/ambulanceDetails/{id}','Api\AppController@AmbulanceDetail');
	Route::get('/diagnostic/{id}','Api\AppController@Diagnostic');
	Route::get('/diagnosticDetails/{id}','Api\AppController@DiagnosticDetail');
	Route::POST('/setAppointment','Api\AppController@Appointments');
	Route::get('/appointment/{id}','Api\AppController@showAppointments');
	Route::get('/about_us','Api\AppController@about_us');
	Route::get('/contact_us','Api\AppController@contact_us');
	Route::get('/privacyPolicy','Api\AppController@privacyPolicy');
});
