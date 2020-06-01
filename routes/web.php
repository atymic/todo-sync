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

Route::get('/', 'PageController@home')->name('home');
Route::get('/about', 'PageController@about')->name('about');

Route::get('/login', 'Auth\LoginController@show')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/redirect/google', 'Auth\LoginController@redirectGoogle')->name('login.google');
Route::get('/callback/google', 'Auth\LoginController@handleGoogle')->name('callback.google');

Route::middleware('auth')->group(function () {
    Route::get('/redirect/todoist', 'Auth\LoginController@redirectTodoist')->name('login.todoist');
    Route::get('/callback/todoist', 'Auth\LoginController@handleTodoist')->name('callback.todoist');

    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::get('settings/toggle', 'SettingsController@toggle')->name('settings.toggle');
    Route::post('settings', 'SettingsController@update')->name('settings.update');
});


