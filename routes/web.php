<?php

Route::group(['middleware' => ['auth','admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', 'Admin\DashboardController@index');
    Route::get('dashboard', 'Admin\DashboardController@dashboard')->name('dashboard.index');
});


Route::get('/articles', function () {
    return view('welcome');
});


Auth::routes();
Route::get('/', 'HomeController@index')->name('home');


Route::get('/test', 'HomeController@index')->name('home');
