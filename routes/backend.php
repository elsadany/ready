<?php

Route::get('backend', function() {
    return redirect('backend/backend-users');
});
Route::group(['prefix' => 'backend', 'namespace' => '\App\Http\Controllers\backend', 'middleware' => ['auth:admin']], function() {
    //Main Categories
    Route::get('categories', 'CategoriesController@index')->name('categories.index');
    Route::any('categories/create', 'CategoriesController@create')->name('categories.create');
    Route::any('categories/update/{category}', 'CategoriesController@update')->name('categories.update');
    Route::post('categories/delete/{category}', 'CategoriesController@delete')->name('categories.delete');
    //General Tags
    Route::get('general_tags', 'GeneralTagsController@index')->name('general_tags.index');
    Route::any('general_tags/create', 'GeneralTagsController@create')->name('general_tags.create');
    Route::any('general_tags/update/{general_tag}', 'GeneralTagsController@update')->name('general_tags.update');
    Route::post('general_tags/delete/{general_tag}', 'GeneralTagsController@delete')->name('general_tags.delete');
    //Offers Notifications
    Route::get('offers_notifications', 'OffersNotificationsController@index')->name('offers_notifications.index');
    Route::any('offers_notifications/create', 'OffersNotificationsController@create')->name('offers_notifications.create');
    Route::any('offers_notifications/update/{offers_notification}', 'OffersNotificationsController@update')->name('offers_notifications.update');
    Route::post('offers_notifications/delete/{offers_notification}', 'OffersNotificationsController@delete')->name('offers_notifications.delete');
    //users
    Route::post('users/delete/{user}', 'UsersController@delete');
    Route::any('users/edit/{user}', 'UsersController@edit');
    Route::any('users/create', 'UsersController@create');
    Route::get('users', 'UsersController@index');
    //Cuisines
    Route::get('cuisines', 'CuisinesController@index')->name('cuisines.index');
    Route::any('cuisines/create', 'CuisinesController@create')->name('cuisines.create');
    Route::any('cuisines/update/{cuisine}', 'CuisinesController@update')->name('cuisines.update');
    Route::post('cuisines/delete/{cuisine}', 'CuisinesController@delete')->name('cuisines.delete');

    //Shops
    Route::get('shops', 'ShopsController@index')->name('shops.index');
    Route::any('shops/create', 'ShopsController@create')->name('shops.create');
    Route::any('shops/update/{shop}', 'ShopsController@update')->name('shops.update');
    Route::post('shops/delete/{shop}', 'ShopsController@delete')->name('shops.delete');

    //Promocodes
    Route::get('promocodes', 'PromoCodesController@index')->name('promocodes.index');
    Route::any('promocodes/create', 'PromoCodesController@create')->name('promocodes.create');
    Route::any('promocodes/update/{promocode}', 'PromoCodesController@update')->name('promocodes.update');
    Route::post('promocodes/delete/{promocode}', 'PromoCodesController@delete')->name('promocodes.delete');


    // branches
    Route::get('branches/{shop?}', 'BranchesController@index')->name('branches.index');
    Route::any('branches/create/{shop}', 'BranchesController@create')->name('branches.create');
    Route::any('branches/edit/{shop}/{branch}', 'BranchesController@edit')->name('branches.edit');
    Route::post('branches/delete/{branch}', 'BranchesController@delete')->name('branches.delete');
    // Orders
    Route::get('orders/{shop?}', 'OrdersController@index')->name('orders.index');
  
    Route::post('orders/delete/{branch}', 'OrderssController@delete')->name('orders.delete');

    // Offers
    Route::get('offers/{shop?}', 'OffersController@index')->name('offers.index');
    Route::get('offers/accept/{offer}', 'OffersController@accept')->name('offers.accept');
    Route::get('offers/refuse/{offer}', 'OffersController@refuse')->name('offers.refuse');
    // Menus
    Route::get('menus/{shop?}', 'MenusController@index')->name('menus.index');
    Route::get('menus/accept/{menu}', 'MenusController@accept')->name('menus.accept');
    Route::get('menus/refuse/{menu}', 'MenusController@refuse')->name('menus.refuse');
    //home Page
    Route::any('home-page','HomePageController@index');
     //Faqs Categories
    Route::get('faqs_categories', 'FaqsCategoriesController@index')->name('faqs_categories.index');
    Route::any('faqs_categories/create', 'FaqsCategoriesController@create')->name('faqs_categories.create');
    Route::any('faqs_categories/update/{faqs_category}', 'FaqsCategoriesController@update')->name('faqs_categories.update');
    Route::post('faqs_categories/delete/{faqs_category}', 'FaqsCategoriesController@delete')->name('faqs_categories.delete');
    //Faq
    Route::any('faq','FaqController@index')->name('faq.index');
    Route::any('faq/save','FaqController@save')->name('faq.save');
    
    // Reviews
    Route::get('reviews/{shop?}', 'ReviewsController@index')->name('reviews.index');
    Route::post('reviews/delete/{review}', 'ReviewsController@delete')->name('reviews.delete');

    //chat
    Route::get('chat','ChatController@index')->name('chat.index');
    Route::get('chat/get-users','ChatController@getUsers')->name('chat.get-users');
});

/*
  |--------------------------------------------------------------------------
  | Shops Routes
  |--------------------------------------------------------------------------
 */
Route::get('shop', function() {
    return redirect('shop/dashboard');
});
Route::group(['prefix' => 'shop', 'namespace' => '\App\Http\Controllers\shops'], function() {
    Route::any('auth/login', 'AuthController@login')->name('shops.login');
    Route::any('auth/forget-password', 'AuthController@forgetPassword')->name('shops.forget-password');
    Route::any('auth/reset-password/{token}', 'AuthController@resetPassword')->name('shops.reset-password');
});
Route::group(['prefix' => 'shop', 'namespace' => '\App\Http\Controllers\shops', 'middleware' => ['auth:shop']], function() {
    Route::get('auth/logout', 'AuthController@logout')->name('backend.logout');
    Route::get('dashboard', 'DashboardController@index')->name('shops.dashboard');
    Route::get('test-upload', 'DashboardController@uploadTest');
    Route::post('upload', 'DashboardController@upload');
    Route::any('available', 'DashboardController@availiblty');


    // ================= Shop Categories ====================
    Route::get('categories','CategoriesController@index');
    Route::any('categories/create','CategoriesController@create');
    Route::any('categories/edit/{category}','CategoriesController@edit');
    Route::post('categories/delete/{category}','CategoriesController@delete');
    
    // ================= Shop Menu ====================
    Route::get('menu','MenuController@index');
    Route::any('menu/create','MenuController@create');
    Route::any('menu/edit/{menu}','MenuController@edit');
    Route::post('menu/delete/{menu}','MenuController@delete');


    // ================= Shop Menu Availibility====================
    Route::get('menu-availibilty','MenuAvailibalityController@index');
  
    Route::any('menu-availibilty/availiable/{menu}','MenuAvailibalityController@availiable');
    Route::any('menu-availibilty/choose/{menu}','MenuAvailibalityController@choose');
    Route::any('menu-availibilty/add/{menu}','MenuAvailibalityController@adds');
   
//============================Orders=========================
    Route::get('orders', 'OrdersController@index')->name('orders.index');
    Route::post('orders/update-status/{order}', 'OrdersController@updateStatus');

    // ================= Shop Offers ====================
    Route::get('offers', 'OffersController@index');
    Route::any('offers/create', 'OffersController@create');
    Route::any('offers/edit/{offer}', 'OffersController@edit');
    Route::post('offers/delete/{offer}', 'OffersController@delete')->name('offers.delete');
//reviews
    Route::get('reviews', 'ReviewsController@index')->name('shop.reviews');
//Days
    Route::get('days', 'DaysController@index')->name('days.index');
    Route::post('days/save', 'DaysController@save')->name('days.save');
});
$days=[
    0=>"السبت",
    1=>"الاحد",
    2=>"الأتنين",
    3=>"الثلاثاء",
    4=>"الأربعاء",
    5=>"الخميس",
    6=>"الجمعه",
    ];
$en_days=[
     0=>"Satarday",
    1=>"Sunday",
    2=>"Monday",
    3=>"Tuesday",
    4=>"WednesDay",
    5=>"Thursday",
    6=>"Friday",
];
define('days', $days);
define('en_days', $en_days);
$status=[
    1=>'تم الطلب',
    2=>'تم الموافقه على الطلب',
    3=>'تم التجهيز',
    4=>'تم التسليم',
    5=>'تم الألغاء'
];
define('status',$status);
