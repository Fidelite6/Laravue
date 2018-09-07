<?php


Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', 'Admin\TestController@index')->name('dashboard.index');
});


Route::get('/articles', function () {
    return view('welcome');
});


Auth::routes();
Route::get('/', 'HomeController@index')->name('home');


Route::get('/test', 'HomeController@index')->name('home');
