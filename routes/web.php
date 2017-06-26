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

Route::get('/', 'HomeController@index')->middleware('auth')->name('home');

Auth::routes();
Route::group(['middleware' => 'manager'], function () {
    Route::get('/job/create', 'JobProjectController@create')->name('job.create');
    Route::post('/job/store', 'JobProjectController@store')->name('job.store');
});

Route::group(['middleware' => 'moderator'], function () {
    Route::get('/job', 'JobProjectController@index');
    Route::get('/job/publish/{token}', 'JobProjectController@publish');
    Route::get('/job/spam/{token}', 'JobProjectController@spam');
});

