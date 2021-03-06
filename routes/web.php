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
Route::get('/read/{id_modul}/chapter/{posisi_bagian}/section/{posisi_subbagian}', 'ReadController@read')->name('read.read');
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
	// Main
	Route::get('/profil', 'MainController@profil')->name('main.profil');
	Route::put('/profil', 'MainController@saveProfil')->name('main.saveProfil');
	// END Main
});

Route::middleware('ADHauth')->group(function () {
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

	// User
	Route::get('/user', 'UserController@index')->name('user.index');
	Route::get('/user/create', 'UserController@create')->name('user.create');
	Route::post('/user', 'UserController@store')->name('user.store');
	Route::get('/user/{id}/edit', 'UserController@edit')->name('user.edit');
	Route::put('/user/{id}', 'UserController@update')->name('user.update');
	Route::delete('/user/{id}', 'UserController@destroy')->name('user.destroy');
	Route::get('/user/{id}/sync', 'UserController@sync')->name('user.sync');
	// END User

	// Hak Akses Peran
	Route::get('/hakaksesperan/{id}', 'HakAksesPeranController@index')->name('hakaksesperan.index');
	Route::put('/hakaksesperan/{id}', 'HakAksesPeranController@update')->name('hakaksesperan.update');
	// END Hak Akses Peran

	// Hak Akses
	Route::get('/hakakses/{id}', 'HakAksesController@index')->name('hakakses.index');
	Route::put('/hakakses/{id}', 'HakAksesController@update')->name('hakakses.update');
	// END Hak Akses

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

	// Modul
	Route::get('/gambar', 'GambarController@index')->name('gambar.index');
	Route::get('/gambar/create', 'GambarController@create')->name('gambar.create');
	Route::post('/gambar', 'GambarController@store')->name('gambar.store');
	Route::get('/gambar/{id}/edit', 'GambarController@edit')->name('gambar.edit');
	Route::put('/gambar/{id}', 'GambarController@update')->name('gambar.update');
	Route::delete('/gambar/{id}', 'GambarController@destroy')->name('gambar.destroy');
	// END Modul

	// Bagian
	Route::get('/bagian/{id}', 'BagianController@index')->name('bagian.index');
	Route::get('/bagian/{id}/create', 'BagianController@create')->name('bagian.create');
	Route::post('/bagian/{id}', 'BagianController@store')->name('bagian.store');
	Route::get('/bagian/{id}/edit', 'BagianController@edit')->name('bagian.edit');
	Route::put('/bagian/{id}', 'BagianController@update')->name('bagian.update');
	Route::delete('/bagian/{id}', 'BagianController@destroy')->name('bagian.destroy');
	Route::get('/bagian/{id}/up', 'BagianController@up')->name('bagian.up');
	Route::get('/bagian/{id}/down', 'BagianController@down')->name('bagian.down');
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
	Route::get('/subbagian/{id}/up', 'SubBagianController@up')->name('subbagian.up');
	Route::get('/subbagian/{id}/down', 'SubBagianController@down')->name('subbagian.down');
	// END Sub Bagian
});