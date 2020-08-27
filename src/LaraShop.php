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
        return Cache::rememberForever('allProducts', function () {
            return LarashopProduct::with(['media', 'parent'])->orderBy('id', 'DESC')->get();
        });
    }

    public function getCategoriesSelect($select = false, $parent = null, $level = 0)
    {
        $color = ['red', 'blue', 'green', 'orange', 'black'];

        $result = LarashopCategory::where('parent_id', $parent)->get();
        foreach ($result as $d) {
            if (is_array($select)) {
                $selected = in_array($d->id, $select) ? 'selected' : '';
            } else {
                $selected = $select && $d->id == $select ? 'selected' : '';
            }
            echo '<option class="level_' . $level . '" ' . $selected . ' value="' . $d->id . '" style="color:' . $color[$level] . '">' . str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $level) . $d->name . '</option>';
            $this->getCategoriesSelect($select, $d['id'], $level + 1);
        }
    }

    public function getCategoryByParent($parent = null)
    {
        return LarashopCategory::where('parent_id', $parent)->orderBy('order', 'ASC')->get();
    }

    public function getCategoryById($id)
    {
        return LarashopCategory::findOrFail('id', $id);
    }

    public function getCategoryProducts(LarashopCategory $larashopCategory, $limit = 12)
    {
        return $larashopCategory->larashopProducts()->paginate($limit);
    }

    public function getProductById($id)
    {
        return LarashopProduct::findOrFail($id);
    }
}
