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

    // Categories
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
