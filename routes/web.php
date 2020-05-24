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

Route::get('/', 'ClientController@index');
Route::get('/form', 'ClientController@index');
Route::get('/results', 'ClientController@results')->name('results');
Route::post('/results', 'ClientController@resultsData')->name('client.resultsData');
Route::get('/results/data', 'ClientController@results')->name('results.data');

Route::resource('client', 'ClientController');
Route::resource('city', 'CityController');
Route::resource('software-developer', 'Software_developerController');
Route::resource('office', 'OfficeController');
Route::resource('application-order', 'Application_orderController');
