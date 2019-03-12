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

// Temp
Route::get('/temp', 'TempController@index')->name('temp.index');
Route::post('/temp', 'TempController@sendData')->name('temp.sendData');
// END Temp

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

// Main
Route::get('/', 'MainController@index')->name('main.index');
Route::post('/login', 'MainController@login')->name('main.login');
Route::get('/logout', 'MainController@logout')->name('main.logout');
// END Main

Route::middleware('MustLoggedIn')->group(function () {

});

Route::middleware('ADHauth')->group(function () {
	
});