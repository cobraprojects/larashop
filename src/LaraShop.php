<?php

namespace CobraProjects\LaraShop;

use CobraProjects\LaraShop\Models\LarashopCategory;
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
}
