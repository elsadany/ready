<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'App\Http\Controllers\apis'], function () {

    //======================= selectors ========================= 
    Route::get('get-map-data', 'HomePageController@getMapData');
    Route::get('languages', 'SelectsController@getLanguages');
    Route::get('locations', 'SelectsController@getLocations');


//============================= Auth =============================
    Route::post('auth/signup', 'AuthApi@register');
    Route::post('auth/signin', 'AuthApi@loginapp');
    Route::post('auth/login-social', 'AuthApi@loginSocial');

//===================== chat admin ========================
    Route::post('backend/chat/send', 'ChatApi@send'); //->middleware('auth:admin');
    Route::get('backend/chat/get-user-messages', 'ChatApi@getUserMessages'); //->middleware('auth:admin');


    Route::group(['middleware' => ['language']], function () {
        Route::get('cuisines', 'SelectsController@getCuisines');
        Route::get('offers_notifications', 'SelectsController@getOffersnotifications');
        Route::get('categories', 'SelectsController@getCategories');
        Route::get('general-tags', 'SelectsController@getFilters');
        Route::get('faqs/categories', 'FaqsController@categories');
        Route::get('faqs', 'FaqsController@index');
        Route::get('about', 'HomePageController@about');
        //====================== cart =========================
        Route::get('cart/clear-all', 'CartApi@clearCart');
        Route::post('cart/add', 'CartApi@add');
        Route::post('cart/get', 'CartApi@get');
        Route::post('cart/clear', 'CartApi@clear');
        Route::post('cart/check-promo', 'CartApi@checkPromo');
        Route::post('cart/increase-item', 'CartApi@increaseItem');
        Route::post('cart/remove-item', 'CartApi@removeItem');
        //======================= shops apia =========================
        Route::get('shops/get', 'ShopsAPI@get');
        Route::get('shops/show/{id}', 'ShopsAPI@show');

        //========================= HomeGroup apia =========================
        Route::get('homepage/get', 'HomePageController@index');
        Route::group(['middleware' => ['auth:api']], function () {
            Route::get('users/myaccount', 'UsersAPI@myacount');
            Route::get('users/notifications', 'UsersAPI@Notifications');
            Route::post('users/update-profile', 'UsersAPI@updateProfile');
            Route::get('users/update-device-id', 'UsersAPI@updateDeviceId');
            Route::post('users/update-password', 'UsersAPI@updatePassword');
            Route::post('users/update-notifcation', 'UsersAPI@updateNotification');
            Route::get('profile/logout', 'UsersAPI@logout');

            // ============= cart ======================
            Route::post('cart/assign-to-user', 'CartApi@assignToUser');
//============================Rating=======================
            Route::post('rating/add', 'RatingAPI@add');
            // ============== addresses =================
            Route::get('address/get', 'UsersAPI@getAdreesses');
            Route::post('address/add', 'UsersAPI@addAdreess');
            Route::post('address/update', 'UsersAPI@updateAdrress');
            Route::post('address/delete', 'UsersAPI@deleteAdrress');

            // =============== orders ====================
            Route::post('checkout', 'CartApi@checkout');
            Route::get('orders', 'UsersAPI@myOrders');
            Route::get('orders/notify', 'UsersAPI@Notify');
            Route::get('orders/last', 'UsersAPI@showLastOrder');
            Route::get('orders/show', 'UsersAPI@showOrder');
            // ============= Chat ===================
            Route::post('chat/send', 'ChatApi@send');
            Route::get('chat/get-user-messages', 'ChatApi@getUserMessages');
        });
    });
});
