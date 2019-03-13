<?php

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


// Public Read Module
Route::get('/read/{id_modul}', 'ReadController@index')->name('read.index');
Route::get('/read/{id_modul}/chapter/{id_bagian}/section/{id_subbagian}', 'ReadController@read')->name('read.read');
// END Public Read Module

// Temp
Route::get('/temp', 'TempController@index')->name('temp.index');
Route::post('/temp', 'TempController@sendData')->name('temp.sendData');
// END Temp

// Main
Route::get('/', 'MainController@index')->name('main.index');
Route::post('/login', 'MainController@login')->name('main.login');
Route::get('/logout', 'MainController@logout')->name('main.logout');
// END Main

Route::middleware('MustLoggedIn')->group(function () {
	// Menu
	Route::get('/menu/{id}/up', 'MenuController@up')->name('menu.up');
	Route::get('/menu/{id}/down', 'MenuController@down')->name('menu.down');
	Route::get('/menu', 'MenuController@index')->name('menu.index');
	Route::get('/menu/create', 'MenuController@create')->name('menu.create');
	Route::post('/menu', 'MenuController@store')->name('menu.store');
	Route::get('/menu/{id}/edit', 'MenuController@edit')->name('menu.edit');
	Route::put('/menu/{id}', 'MenuController@update')->name('menu.update');
	Route::delete('/menu/{id}', 'MenuController@destroy')->name('menu.destroy');
	// END Menu

	// Hak Akses Peran
	Route::get('/hakaksesperan/{id}', 'HakAksesPeranController@index')->name('hakaksesperan.index');
	Route::put('/hakaksesperan/{id}', 'HakAksesPeranController@update')->name('hakaksesperan.update');
	// END Hak Akses Peran

	// Peran
	Route::get('/peran', 'PeranController@index')->name('peran.index');
	Route::get('/peran/create', 'PeranController@create')->name('peran.create');
	Route::post('/peran', 'PeranController@store')->name('peran.store');
	Route::get('/peran/{id}/edit', 'PeranController@edit')->name('peran.edit');
	Route::put('/peran/{id}', 'PeranController@update')->name('peran.update');
	Route::delete('/peran/{id}', 'PeranController@destroy')->name('peran.destroy');
	Route::get('/peran/{id}/sync', 'PeranController@sync')->name('peran.sync');
	// END Peran

	// Modul
	Route::get('/modul', 'ModulController@index')->name('modul.index');
	Route::get('/modul/create', 'ModulController@create')->name('modul.create');
	Route::post('/modul', 'ModulController@store')->name('modul.store');
	Route::get('/modul/{id}/edit', 'ModulController@edit')->name('modul.edit');
	Route::put('/modul/{id}', 'ModulController@update')->name('modul.update');
	Route::delete('/modul/{id}', 'ModulController@destroy')->name('modul.destroy');
	// END Modul

	// Bagian
	Route::get('/bagian/{id}', 'BagianController@index')->name('bagian.index');
	Route::get('/bagian/{id}/create', 'BagianController@create')->name('bagian.create');
	Route::post('/bagian/{id}', 'BagianController@store')->name('bagian.store');
	Route::get('/bagian/{id}/edit', 'BagianController@edit')->name('bagian.edit');
	Route::put('/bagian/{id}', 'BagianController@update')->name('bagian.update');
	Route::delete('/bagian/{id}', 'BagianController@destroy')->name('bagian.destroy');
	// END Bagian

	// Sub Bagian
	Route::get('/subbagian/{id}', 'SubBagianController@index')->name('subbagian.index');
	Route::get('/subbagian/{id}/create', 'SubBagianController@create')->name('subbagian.create');
	Route::post('/subbagian/{id}', 'SubBagianController@store')->name('subbagian.store');
	Route::get('/subbagian/{id}/edit', 'SubBagianController@edit')->name('subbagian.edit');
	Route::put('/subbagian/{id}', 'SubBagianController@update')->name('subbagian.update');
	Route::delete('/subbagian/{id}', 'SubBagianController@destroy')->name('subbagian.destroy');
	Route::get('/subbagian/{id}/document', 'SubBagianController@document')->name('subbagian.document');
	Route::put('/subbagian/{id}/document', 'SubBagianController@saveDocument')->name('subbagian.saveDocument');
	// END Sub Bagian

});

Route::middleware('ADHauth')->group(function () {
	
});