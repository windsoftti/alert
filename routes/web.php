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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::post('prospectos-webhook', 'WebhookController@handle');

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('data')->group(function () {
    Route::resource('prospectos', 'DataProspectoController');
});

Route::prefix('home')->group(function () {

    Route::get('prospectos-followup', 'ProspectoController@followup');

    Route::get('users-promotores-del-gerente/{id}','UserController@promotoresDelGerenteAjax');
    Route::get('users-asignar', 'UserController@asignar');
    Route::post('users-asignar', 'UserController@asignarUpdate');

    Route::get('users-promotores', 'UserController@promotores');
    Route::get('users-gerentes', 'UserController@gerentes');

    Route::resource('prospectos', 'ProspectoController');
    Route::resource('users', 'UserController');

    Route::get('chats-lead/{id}','ChatController@chatsLeadAjax');

    Route::resource('chats', 'ChatController');
    Route::resource('assignments', 'ChatController');
    Route::resource('seguimientos', 'SeguimientoController');

});