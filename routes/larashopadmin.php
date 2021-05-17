<?php

Route::name(LaraShop::adminName() . '.')->group(function () {

    // Categories
    Route::resource('/category', 'LarashopCategoryController');

    // Brands
    Route::resource('/brand', 'LarashopBrandController');

    // Coupons
    Route::resource('/coupon', 'LarashopCouponController');

    // Products
    Route::resource('/product', 'LarashopProductController');
    Route::get('/product/media/{media}', 'LarashopProductController@deleteMedia')->name('product.media.delete');

    // Cities
    Route::resource('/city', 'LarashopCityController');

    // Orders
    Route::resource('/order', 'LarashopOrderController')->only(['index', 'show']);
    Route::post('/order/{order}/changePaymentStatus', 'LarashopOrderController@changePaymentStatus')->name('order.changePaymentStatus');
    Route::post('/order/{order}/changeOrderStatus', 'LarashopOrderController@changeOrderStatus')->name('order.changeOrderStatus');

    // Settings
    Route::get('/setting', 'LarashopSettingController@index')->name('setting.index');
    Route::post('/setting', 'LarashopSettingController@store');
});
