<?php
Route::group(['namespace' => 'Elsayednofal\BackendRoles\Http\Controllers','prefix'=>config('backend-roles.url_prefix'),'middleware'=>['web']], function()
{
    Route::any('pages/url-matcher','PagesController@urlMatcher');
});

Route::group(['namespace' => 'Elsayednofal\BackendRoles\Http\Controllers','prefix'=>config('backend-roles.url_prefix'),'middleware'=> ['web']], function()
{
    Route::any('pages/generate','PagesController@generate');
    Route::any('roles/lock','RolesController@lock');
    
});
Route::group(['namespace' => 'Elsayednofal\BackendRoles\Http\Controllers','prefix'=>config('backend-roles.url_prefix'),'middleware'=> config('backend-roles.middlewares')], function()
{
    
    //************** Roles ***********************************
    Route::any('roles/create','RolesController@create');
    Route::any('roles/update/{id}','RolesController@update');
    Route::any('roles/delete/{id}','RolesController@delete');
    Route::any('roles/actions/{role_id}','RolesController@actions');
    Route::any('roles','RolesController@index');
});

Route::group(['namespace' => 'Elsayednofal\BackendRoles\Http\Controllers','prefix'=>config('backend-roles.url_prefix'),'middleware'=> ['web','auth:admin']], function()
{
    //************** Pages ***********************************
    Route::any('pages/create','PagesController@anyCreate');
    Route::any('pages/update/{id}','PagesController@anyUpdate');
    Route::any('pages/delete/{id}','PagesController@anyDelete');
    Route::any('pages','PagesController@anyIndex');
});

