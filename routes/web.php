<?php

Auth::routes();

Route::middleware('guest')->group(function () {
    Route::post('/login', 'Auth\LoginController@auth')->name('login');
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'Auth\RegisterController@registration');
});

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');






Route::group(['middleware' => ['auth','admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', 'Admin\DashboardController@index');
    Route::get('dashboard', 'Admin\DashboardController@dashboard')->name('dashboard.index');
});


//Route::get('/articles', function () {
//    return view('welcome');
//});



Route::get('/', 'HomeController@index')->name('home');

