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

//Route::middleware('auth:api')->get('/user', function (Request $request) {return $request->user();});
//Route::get('hospitals', 'HospitalController@index');
//Route::post('hospitals', 'HospitalController@store');
Route::resource('hospitals', 'HospitalController')->except('update','create','edit');
Route::resource('laboratories', 'LaboratoryController')->except('update','create','edit');
Route::resource('administrations', 'AdministrationController')->except('update','create','edit');
Route::resource('wilayas', 'WilayaController')->except('update','create','edit');
Route::resource('diseases', 'DiseaseController')->except('update','create','edit');
Route::resource('patients', 'PatientController')->except('create','edit');
Route::resource('test', 'TestController')->except('update','destroy','create','edit');
Route::resource('deseases_hospital', 'DeseasesHospitalController')->except('update','destroy','create','edit');
Route::post('test/response', 'TestController@response');
Route::get('test/laboratory/{id}', 'TestController@show_by_laboratory');
Route::get('test/hospital/{id}', 'TestController@show_by_hospital');
Route::get('test/patient/{id}', 'TestController@show_by_patient');
Route::get('test/disease/{id}', 'TestController@show_by_disease');
Route::post('deseases_hospital/cure', 'DeseasesHospitalController@cured');
Route::post('deseases_hospital/dead', 'DeseasesHospitalController@dead');
Route::get('stat/{wilaya}', 'DeseasesHospitalController@stat_wilaya');
Route::get('stat', 'DeseasesHospitalController@stat');
Route::post('login/administration', 'AdministrationController@login');
Route::post('login/hospital', 'HospitalController@login');
Route::post('login/laboratory', 'LaboratoryController@login');
Route::post('hospitals/besthospital', 'HospitalController@get_best_hospital');
Route::put('hospitals/allocate','HospitalController@take_aplace');
Route::put('hospitals/free','HospitalController@free_aplace');
Route::put('hospitals/coordinates','HospitalController@set_coordinates');












