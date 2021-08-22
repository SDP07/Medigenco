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




Route::post('/language', 'LanguageController@changeLanguage')->name('language.change');
Route::post('/currency', 'CurrencyController@changeCurrency')->name('currency.change');

Auth::routes(['verify' => true]);
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
Route::get('/verification-confirmation/{code}', 'Auth\VerificationController@verification_confirmation')->name('email.verification.confirmation');
Route::post('/logpost','LogController@Login')->name('logPost');

//Home Page
Route::get('/', 'HomeController@index')->name('home');
Route::post('/home/section/featured', 'HomeController@load_featured_section')->name('home.section.featured');
Route::post('/home/section/best_selling', 'HomeController@load_best_selling_section')->name('home.section.best_selling');
Route::post('/home/section/home_categories', 'HomeController@load_home_categories_section')->name('home.section.home_categories');
Route::post('/home/section/best_sellers', 'HomeController@load_best_sellers_section')->name('home.section.best_sellers');
//category dropdown menu ajax call
Route::post('/category/nav-element-list', 'HomeController@get_category_items')->name('category.elements');

//Flash Deal Details Page
Route::get('/flash-deal/{slug}', 'HomeController@flash_deal_details')->name('flash-deal-details');

// Route::get('/sitemap.xml', function(){
// 	return base_path('sitemap.xml');
// });
Route::get('/users/login', 'HomeController@login')->name('user.login');
Route::get('/users/registration', 'HomeController@registration')->name('user.registration');
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/search?q={search}', 'HomeController@search')->name('suggestion.search');
Route::post('/ajax-search', 'HomeController@ajax_search')->name('search.ajax');


Route::get('/demo', 'LogController@demo');

Route::resource('profile','ProfileController');

Route::group(['prefix' =>'admin_dashboard', 'middleware' => ['auth', 'admin']], function(){
    Route::get('/', 'AdminController@dashboard')->name('admin_dashboard'); 
	Route::resource('profile','ProfileController');
	Route::resource('doctors','DoctorController');
    Route::resource('locations','LocationController');
    Route::resource('clinics','clinicController');
	Route::get('/doctorClinic','DoctorController@ClinicIndex')->name('clinic.doctor');
	Route::get('/newDoctorClinic','DoctorController@ClinicCreate')->name('clinic.doctor.new');
    Route::post('/newDoctorClinicPost','DoctorController@ClinicSave')->name('clinic.doctor.post');
    Route::get('/newDoctorEdit/{id}','DoctorController@ClinicEdit')->name('clinic.doctor.edit');
    Route::post('/newDoctorUpdate/{id}','DoctorController@ClinicUpdate')->name('clinic.doctor.update');
    Route::resource('/hospitals','HospitalController');
});

Route::get('/doctorClinic','DoctorController@Details')->name('doctor.clinic');

Route::get('/', function () {
    if(\Auth::id() == null){
    	return redirect('/login');

    }
    else{
    	return redirect()->route('admin_dashboard');
    }
});