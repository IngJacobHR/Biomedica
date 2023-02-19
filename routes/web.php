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

Route::get('equipment', 'EquipmentController@index')->name('equipment.index');
Route::get('equipment/create', 'EquipmentController@create')->name('equipment.create');
Route::post('equipment', 'EquipmentController@store')->name('equipment.store');

Route::get('technology', 'TechnologyController@index')->name('technology.index');
Route::delete('technology/{technology}', 'TechnologyController@destroy')->name('technology.destroy')->middleware('manager');
Route::group(['middleware'=>['adminmanager']], function() {
    Route::get('technology/create', 'TechnologyController@create')->name('technology.create');
    Route::post('technology', 'TechnologyController@store')->name('technology.store');
    Route::get('technology/{technology}', 'TechnologyController@show')->name('technology.show');
    Route::get('technology/{technology}/edit', 'TechnologyController@edit')->name('technology.edit');
    Route::match(['put', 'patch'], 'technology_edit/{technology}','TechnologyController@update')->name('technology.update');
    Route::delete('technology/{technology}', 'TechnologyController@destroy')->name('technology.destroy');
    Route::match(['put', 'patch'], 'technology/{technology}','TechnologyController@adjuntar')->name('technology.adjuntar');
    Route::delete('support/{id}', 'SupportController@destroy')->name('support.destroy');
    Route::get('support/{support}/edit', 'SupportController@edit')->name('support.edit');
    Route::match(['put', 'patch'], 'support_edit/{support}','SupportController@update')->name('support.update');
    Route::match(['put', 'patch'], 'support/{support}','SupportController@execute')->name('support.execute');
});

Route::get('maintenance', 'MaintenanceController@index')->name('maintenance.index');

Route::get('documnetos/{technology}', 'DocumentsController@index')->name('documents.index');
Route::get('file/{technology}', 'DocumentsController@file')->name('documents.file');
Route::group(['middleware'=>['adminmanager']], function() {
    Route::get('documnets/{technology}', 'DocumentsController@show')->name('documents.show');
    Route::post('cargar/{technology}', 'DocumentsController@store')->name('documents.store');
    Route::get('documnets/{technology}', 'DocumentsController@show')->name('documents.show');
    Route::delete('/delete-documnetos/{file}', 'DocumentsController@destroy')->name('documents.destroy');
});

Route::get('sedes/{campus}', 'CampusController@show')->name('campus.show');
Route::get('servicios/{campus}', 'CampusController@store')->name('campus.store');
Route::get('estado/{campus}', 'CampusController@edit')->name('campus.edit');
Route::get('shear', 'CampusController@update')->name('campus.update');




Route::get('workorders', 'WorkordersController@index')->name('workorders.index');
Route::get('workorders/OT', 'WorkordersController@OT')->name('workorders.OT')->middleware('manager');
Route::get('workorders/create', 'WorkordersController@create')->name('workorders.create');
Route::post('workorders/create/send', 'WorkordersController@store')->name('workorders.store');
Route::get('workorders/tracing', 'WorkordersController@show')->name('workorders.show');
Route::get('workorders/{workorders}/modal', 'WorkordersController@modal')->name('workorders.modal');
Route::post('workorders/{workorders}/evaluation', 'WorkordersController@evaluation')->name('workorders.evaluation');
Route::group(['middleware'=>['adminmanager']], function() {
    Route::get('workorders/support', 'WorkordersController@support')->name('workorders.support');
    Route::get('workorders/{workorders}/edit', 'WorkordersController@edit')->name('workorders.edit');
    Route::get('workorders/{workorders}/execute', 'WorkordersController@execute')->name('workorders.execute');
    Route::post('workorders_edit/{workorders}','WorkordersController@update')->name('workorders.update');
    Route::post('workorders_execute/{workorders}','WorkordersController@updatesupport')->name('workorders.updatesupport');
    Route::get('/indicadores.biomédicos', 'WorkordersController@indicators')->name('indicators');
});

Route::get('locative/OT', 'LocativeController@OT')->name('locative.OT')->middleware('sadmin');
Route::get('locative/{locative}/edit', 'LocativeController@edit')->name('locative.edit')->middleware('sadmin');
Route::group(['middleware'=>['assis']], function() {
    Route::post('locative/create/send', 'locativeController@store')->name('locative.store');
    Route::post('locative_edit/{locative}','LocativeController@update')->name('locative.update');
    Route::get('locative/support', 'LocativeController@support')->name('locative.support');
    Route::get('locative/{locative}/execute', 'LocativeController@execute')->name('locative.execute');
    Route::post('locative_execute/{locative}','locativeController@updatesupport')->name('locative.updatesupport');
    Route::get('/indicadores.locativos', 'LocativeController@indicators')->name('indicators.locative');
});

Route::group(['middleware'=>['operative']], function() {
    Route::get('locative/create', 'locativeController@create')->name('locative.create');
    Route::get('locative/tracing', 'LocativeController@show')->name('locative.show');
    Route::post('locative/create/send', 'locativeController@store')->name('locative.store');
    Route::get('locative/{locative}/report', 'LocativeController@report')->name('locative.report');
    Route::post('locative/{locative}/evaluation', 'LocativeController@evaluation')->name('locative.evaluation');
});

Route::get('support', 'SupportController@index')->name('support.index');

Route::get('/admin', 'UserController@index')->name('users.index');
Route::get('/edit/{usuario}', 'UserController@edit')->name('users.edit');
Route::patch('/edit/{usuario}', 'UserController@update')->name('users.update');

Route::get('/actualizar', 'MaintenanceController@store')->name('actualizar');

Route::get('sense', 'SenseController@index')->name('sense');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('event/{id}', [App\Http\Controllers\SensorController::class, 'event'])->name('event');
Route::post('event/{id}', [App\Http\Controllers\SensorController::class, 'event'])->name('event');

Route::resource('sensors', 'SenseController');

Route::get('/eventedit/{id}/{name}', 'SensorController@eventEdit')->name('eventedit');
Route::patch('/eventeditupdate/{id}', [App\Http\Controllers\SensorController::class, 'eventEditUpdate'])->name('eventupdate');
Route::post('/event/{id}', [App\Http\Controllers\SensorController::class, 'filterEvent'])->name('filterEvent');

Route::get('/dailychart/{id}', [App\Http\Controllers\SensorController::class, 'id'])->name('id');
Route::post('/historicchart/{id}', [App\Http\Controllers\SensorController::class, 'filter'])->name('filter');

Route::post('/dailychart/{id}', [App\Http\Controllers\SensorController::class, 'filterDaily'])->name('filterDaily');

Route::get('/historic/{id}', [App\Http\Controllers\SensorController::class, 'historic'])->name('historic');


Auth::routes(['verify'=>true]);

//Route::get('/home', 'HomeController@index')->name('home');
//brdjcyhybhdyuiam
