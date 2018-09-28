<?php

Route::group([ 'prefix' => 'auth' ], function () {
    Route::post('login', 'API\Auth\AuthController@login');
    Route::post('register', 'API\Auth\AuthController@signup');


    Route::group([ 'middleware' => 'auth:api' ], function () {
        Route::get('logout', 'API\Auth\AuthController@logout');
        Route::get('user', 'API\Auth\AuthController@user');
    });
});





//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//
//Route::resource('articles', 'ArticleController', [ 'only' => [
//    'index', 'show', 'store', 'destroy',
//] ]);
//
//Route::put('articles', 'ArticleController@store')->name('articles.update');
