<?php

Route::name(LaraShop::adminName() . '.')->group(function () {

    // Categories
    Route::name('category.')->prefix('category')->group(function () {
        Route::get('/', 'LarashopCategoryController@index')->name('index');
        Route::get('/create', 'LarashopCategoryController@create')->name('create');
        Route::get('/{larashopCategory}/edit', 'LarashopCategoryController@edit')->name('edit');
        Route::post('/', 'LarashopCategoryController@store')->name('store');
        Route::put('/{larashopCategory}', 'LarashopCategoryController@update')->name('update');
        Route::delete('/{larashopCategory}', 'LarashopCategoryController@destroy')->name('destroy');
    });

    // Brands
    Route::name('brand.')->prefix('brand')->group(function () {
        Route::get('/', 'LarashopBrandController@index')->name('index');
        Route::get('/create', 'LarashopBrandController@create')->name('create');
        Route::get('/{larashopBrand}/edit', 'LarashopBrandController@edit')->name('edit');
        Route::post('/', 'LarashopBrandController@store')->name('store');
        Route::put('/{larashopBrand}', 'LarashopBrandController@update')->name('update');
        Route::delete('/{larashopBrand}', 'LarashopBrandController@destroy')->name('destroy');
    });

    // Coupons
    Route::name('coupon.')->prefix('coupon')->group(function () {
        Route::get('/', 'LarashopCouponController@index')->name('index');
        Route::get('/create', 'LarashopCouponController@create')->name('create');
        Route::get('/{larashopCoupon}/edit', 'LarashopCouponController@edit')->name('edit');
        Route::post('/', 'LarashopCouponController@store')->name('store');
        Route::put('/{larashopCoupon}', 'LarashopCouponController@update')->name('update');
        Route::delete('/{larashopCoupon}', 'LarashopCouponController@destroy')->name('destroy');
    });

    // Products
    Route::name('product.')->prefix('product')->group(function () {
        Route::get('/', 'LarashopProductController@index')->name('index');
        Route::get('/create', 'LarashopProductController@create')->name('create');
        Route::get('/{larashopProduct}/edit', 'LarashopProductController@edit')->name('edit');
        Route::post('/', 'LarashopProductController@store')->name('store');
        Route::put('/{larashopProduct}', 'LarashopProductController@update')->name('update');
        Route::delete('/{larashopProduct}', 'LarashopProductController@destroy')->name('destroy');
        Route::get('/media/{media}', 'LarashopProductController@deleteMedia')->name('media.delete');
    });
});
