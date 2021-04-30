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
Route::group(['middleware'=>['adminmanager']], function() {
    Route::get('technology/create', 'TechnologyController@create')->name('technology.create');
    Route::post('technology', 'TechnologyController@store')->name('technology.store');
    Route::get('technology/{technology}', 'TechnologyController@show')->name('technology.show');
    Route::get('technology/{technology}/edit', 'TechnologyController@edit')->name('technology.edit');
    Route::match(['put', 'patch'], 'technology_edit/{technology}','TechnologyController@update')->name('technology.update');
    Route::delete('technology/{technology}', 'TechnologyController@destroy')->name('technology.destroy');
    Route::match(['put', 'patch'], 'technology/{technology}','TechnologyController@adjuntar')->name('technology.adjuntar');
});

Route::get('maintenance', 'MaintenanceController@index')->name('maintenance.index');

Route::get('documnetos/{technology}', 'DocumentsController@index')->name('documents.index');
Route::group(['middleware'=>['adminmanager']], function() {
    Route::get('documnets/{technology}', 'DocumentsController@show')->name('documents.show');
    Route::post('cargar/{technology}', 'DocumentsController@store')->name('documents.store');
    Route::get('documnets/{technology}', 'DocumentsController@show')->name('documents.show');
    Route::delete('/delete-documnetos/{file}', 'DocumentsController@destroy')->name('documents.destroy');
});

Route::get('sedes/{campus}', 'CampusController@show')->name('campus.show');
Route::get('servicios/{campus}', 'CampusController@store')->name('campus.store');



Route::get('workorders', 'WorkordersController@index')->name('workorders.index');
Route::get('workorders/OT', 'WorkordersController@OT')->name('workorders.OT')->middleware('manager');
Route::get('workorders/create', 'WorkordersController@create')->name('workorders.create');
Route::post('workorders/create/send', 'WorkordersController@store')->name('workorders.store');
Route::get('workorders/tracing', 'WorkordersController@show')->name('workorders.show');
Route::get('workorders/{workorders}/modal', 'WorkordersController@modal')->name('workorders.modal');
Route::group(['middleware'=>['adminmanager']], function() {
    Route::get('workorders/support', 'WorkordersController@support')->name('workorders.support');
    Route::get('workorders/{workorders}/edit', 'WorkordersController@edit')->name('workorders.edit');
    Route::get('workorders/{workorders}/execute', 'WorkordersController@execute')->name('workorders.execute');
    Route::post('workorders_edit/{workorders}','WorkordersController@update')->name('workorders.update');
    Route::post('workorders_execute/{workorders}','WorkordersController@updatesupport')->name('workorders.updatesupport');
});


Route::group(['middleware'=>['sadmin']], function() {
    Route::get('locative/create', 'locativeController@create')->name('locative.create');
    Route::post('locative/create/send', 'locativeController@store')->name('locative.store');
    Route::get('locative/OT', 'LocativeController@OT')->name('locative.OT');
    Route::get('locative/{locative}/edit', 'LocativeController@edit')->name('locative.edit');
    Route::post('locative_edit/{locative}','LocativeController@update')->name('locative.update');
    Route::get('locative/support', 'LocativeController@support')->name('locative.support');
    Route::get('locative/{locative}/execute', 'LocativeController@execute')->name('locative.execute');
    Route::post('locative_execute/{locative}','locativeController@updatesupport')->name('locative.updatesupport');
    Route::get('locative/tracing', 'LocativeController@show')->name('locative.show');
    Route::get('locative/{locative}/report', 'LocativeController@report')->name('locative.report');
});



Route::get('/admin', 'UserController@index')->name('users.index');
Route::get('/edit/{usuario}', 'UserController@edit')->name('users.edit');
Route::patch('/edit/{usuario}', 'UserController@update')->name('users.update');

Auth::routes(['verify'=>true]);

//Route::get('/home', 'HomeController@index')->name('home');
