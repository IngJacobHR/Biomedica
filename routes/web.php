<?php

use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'MainController@index')->name('menu');

Route::get('technology', 'TechnologyController@index')->name('technology.index');
Route::get('technology/create', 'TechnologyController@create')->name('technology.create');
Route::post('technology', 'TechnologyController@store')->name('technology.store');
Route::get('technology/{technology}', 'TechnologyController@show')->name('technology.show');
Route::get('technology/{technology}/edit', 'TechnologyController@edit')->name('technology.edit');
Route::match(['put', 'patch'], 'technology_edit/{technology}','TechnologyController@update')->name('technology.update');
Route::delete('technology/{technology}', 'TechnologyController@destroy')->name('technology.destroy');
Route::match(['put', 'patch'], 'technology/{technology}','TechnologyController@adjuntar')->name('technology.adjuntar');

Route::get('maintenance', 'MaintenanceController@index')->name('maintenance.index');


//Route::get('maintenance/{technology}/mant', 'MaintenanceController@edit')->name('maintenance.create');

Route::get('documnets/{technology}', 'DocumentsController@show')->name('documents.show');
Route::post('cargar/{technology}', 'DocumentsController@store')->name('documents.store');
Route::get('documnetos/{technology}', 'DocumentsController@index')->name('documents.index');
Route::delete('/delete-documnetos/{file}', 'DocumentsController@destroy')->name('documents.destroy');

Route::get('sedes/{campus}', 'CampusController@show')->name('campus.show');
Route::get('servicios/{campus}', 'CampusController@store')->name('campus.store');

Route::get('workorders', 'WorkordersController@index')->name('workorders.index');
Route::get('workorders/create', 'WorkordersController@create')->name('workorders.create');
Route::post('workorders/create/send', 'WorkordersController@store')->name('workorders.store');
Route::get('workorders/tracing', 'WorkordersController@show')->name('workorders.show');
Route::get('workorders/{workorders}/edit', 'WorkordersController@edit')->name('workorders.edit');
Route::match(['put', 'patch'], 'workorders_edit/{workorders}','WorkordersController@update')->name('workorders.update');


Route::get('/admin', 'UserController@index')->name('users.index');
Route::get('/edit/{usuario}', 'UserController@edit')->name('users.edit');
Route::patch('/edit/{usuario}', 'UserController@update')->name('users.update');

Auth::routes(['verify'=>true]);

//Route::get('/home', 'HomeController@index')->name('home');
