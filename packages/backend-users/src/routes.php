<?php

Route::group([
    'middleware' => config('backend-users.middlewares'),
    'namespace'=>'ElsayedNofal\BackendUsers\controllers',
    'prefix'=>config('backend-users.url_prefix')
], function () {

    // ############################ Admin Crud ##############################
    Route::get('backend-users/create', 'BackendUsers@create')->name('backend-users.create');
    Route::get('backend-users/update/{user}', 'BackendUsers@update')->name('backend-users.update');
    Route::post('backend-users/delete/{user}', 'BackendUsers@delete')->name('backend-users.delete');
    Route::post('backend-users/store', 'BackendUsers@store')->name('backend-users.store');
    Route::get('backend-users', 'BackendUsers@index')->name('backend-users');


});


Route::group([
    'middleware' => ['web','auth:admin'],
    'namespace'=>'ElsayedNofal\BackendUsers\controllers',
    'prefix'=>config('backend-users.url_prefix')
], function () {
    Route::any('backend-users/profile', 'BackendUsers@profile')->name('backend-users.profile');
    Route::get('auth/logout','AuthController@logout')->name('backend.logout');


});


Route::group([
    'middleware' => ['web'],
    'namespace'=>'ElsayedNofal\BackendUsers\controllers',
    'prefix'=>config('backend-users.url_prefix')
], function () {
    // ########################### Auth Routes ##############################
    Route::get('auth/login','AuthController@login')->name('backend.login');
    Route::post('auth/auth','AuthController@auth')->name('auth.auth');
    Route::any('auth/forget-password','AuthController@forgetPassword')->name('auth.forget-password');
    Route::any('auth/reset-password/{token}','AuthController@resetPassword')->name('auth.reset-password');
});

