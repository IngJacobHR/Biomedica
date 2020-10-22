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

Route::get('/', 'MainController@index')->name('menu');

Route::get('technology', 'TechnologyController@index')->name('technology.index');
Route::get('technology/create', 'TechnologyController@create')->name('technology.create');
Route::post('technology', 'TechnologyController@store')->name('technology.store');
Route::get('technology/{technology}', 'TechnologyController@show')->name('technology.show');
Route::get('technology/{technology}/edit', 'TechnologyController@edit')->name('technology.edit');
Route::get('technology/{technology}/mant', 'TechnologyController@mant')->name('technology.mant');
Route::match(['put', 'patch'], 'technology_edit/{technology}','TechnologyController@update')->name('technology.update');
Route::delete('technology/{technology}', 'TechnologyController@destroy')->name('technology.destroy');
Route::match(['put', 'patch'], 'technology/{technology}','TechnologyController@adjuntar')->name('technology.adjuntar');


//Route::get('maintenance/{technology}/mant', 'MaintenanceController@edit')->name('maintenance.create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
