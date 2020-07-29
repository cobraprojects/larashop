<?php

use CobraProjects\LaraShop\Facades\LaraShop;

Route::name(LaraShop::getAdminRouteName() . '.')->group(function () {

    // Categories
    Route::name('category.')->prefix('category')->group(function () {
        Route::get('/', 'LarashopCategoryController@index')->name('index');
        Route::get('/create', 'LarashopCategoryController@create')->name('create');
        Route::get('/{larshopCategory}/edit', 'LarashopCategoryController@edit')->name('edit');
        Route::post('/', 'LarashopCategoryController@store');
        Route::put('/{larshopCategory}', 'LarashopCategoryController@update');
        Route::delete('/{larshopCategory}', 'LarashopCategoryController@destroy')->name('destroy');
    });
});
