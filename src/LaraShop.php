<?php

namespace CobraProjects\LaraShop;

use CobraProjects\LaraShop\Models\LarashopCategory;
use CobraProjects\LaraShop\Models\LarashopProduct;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class LaraShop
{
    public function getPrefix()
    {
        return config('larashop.frontend_prefix');
    }

    public function getAdminPrefix()
    {
        return config('larashop.backend_prefix');
    }

    public function adminName()
    {
        return Str::of($this->getAdminPrefix())->explode('/')->implode('.');
    }

    public function getShopRouteName()
    {
        return Str::of($this->getAdminPrefix())->explode('/')->last();
    }

    public function getAllCategories()
    {
        return LarashopCategory::with(['media', 'parent'])->orderBy('order', 'ASC')->get();
    }

    public function getAllProducts()
    {
        return Cache::forever('allProducts', function () {
            return LarashopProduct::with(['media', 'parent'])->orderBy('id', 'DESC')->get();
        });
    }
}
