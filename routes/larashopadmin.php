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
});
