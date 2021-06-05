<?php

namespace CobraProjects\LaraShop;

use CobraProjects\LaraShop\Models\LarashopCategory;
use CobraProjects\LaraShop\Models\LarashopProduct;
use CobraProjects\LaraShop\Models\LarashopSetting;
use CobraProjects\LaraShop\Models\LarashopSocial;
use Gloudemans\Shoppingcart\Facades\Cart;
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
        return LarashopCategory::where('parent_id', $parent)->withCount('larashopProducts')->orderBy('order', 'ASC')->get();
    }

    public function getSubCategoriesFilter(array $categories)
    {
        return LarashopCategory::whereIn('parent_id', $categories)->withCount('larashopProducts')->orderBy('order', 'ASC')->get();
    }

    public function getCategoryById($id)
    {
        return LarashopCategory::findOrFail($id);
    }

    public function getCategoryProducts(LarashopCategory $larashopCategory, $limit = 12)
    {
        return $larashopCategory->larashopProducts()->where('hidden', 0)->orderBy('id', 'DESC')->paginate($limit);
    }

    public function getProductsInCategories(array $categories, $limit = 12)
    {
        return LarashopProduct::where('hidden', 0)->whereHas('larashopCategories', fn($q) => $q->whereIn('larashop_categories.id', $categories))->orderBy('id', 'DESC')->paginate($limit);
    }

    public function getProductById($id)
    {
        return LarashopProduct::findOrFail($id);
    }

    public function addToCart(LarashopProduct $larashopProduct, $qty = 1, $options = [])
    {
        Cart::add($larashopProduct, $qty, $options);
    }

    public function addToWishList(LarashopProduct $larashopProduct, $qty = 1, $options = [])
    {
        Cart::Instance('wishlist')->add($larashopProduct, $qty, $options);
    }

    public function moveToCart($rowId)
    {
        $product = Cart::get($rowId);
        $this->addToCart($product);
        $this->removefromWithList($rowId);
    }

    public function moveToWithList($rowId)
    {
        $product = Cart::get($rowId);
        $this->addToWishList($product);
        $this->removefromCart($rowId);
    }

    public function updateQty($rowId, $qty)
    {
        Cart::update($rowId, $qty);
    }

    public function removefromCart($rowId)
    {
        Cart::remove($rowId);
    }

    public function removefromWithList($rowId)
    {
        Cart::Instance('wishlist')->remove($rowId);
    }

    public function cartItems($instance = 'default')
    {
        return Cart::Instance($instance)->content();
    }

    public function storeCart($user)
    {
        Cart::store($user->id);
        Cart::Instance('wishlist')->store($user->id);
    }

    public function restoreCart($user)
    {
        Cart::restore($user->id);
        Cart::Instance('wishlist')->restore($user->id);
    }

    public function deleteCart($user)
    {
        Cart::erase($user->id);
    }

    public function emptyCart()
    {
        Cart::destroy();
    }

    public function cartTotal()
    {
        return Cart::total();
    }

    public function cartLogin($user)
    {
        // remove non existent items from cart
        foreach (Cart::content() as $key => $value) {
            if (!LarashopProduct::find($value->model->id)) {
                $this->removefromCart($key);
            }
        }

        $old = Cart::content();
        Cart::restore($user->id);
        $old->merge(Cart::content());
        Cart::store($user->id);
        Cart::content();
    }

    private function setting(): LarashopSetting
    {
        return Cache::rememberForever('larashopSettings', function () {
            return LarashopSetting::first() ?? new LarashopSetting();
        });
    }

    public function siteName()
    {
        return $this->setting()->name;
    }

    public function siteDescription()
    {
        return $this->setting()->description;
    }

    public function sitePhone()
    {
        return $this->setting()->phone;
    }

    public function siteEmail()
    {
        return $this->setting()->email;
    }

    public function siteWhatsapp()
    {
        return $this->setting()->whatsapp;
    }

    public function countryName()
    {
        return $this->setting()->country_name;
    }

    public function currencyName()
    {
        return $this->setting()->currency_name;
    }

    public function currencySymbol()
    {
        return $this->setting()->currency_symbol ?? $this->currencyName();
    }

    public function social()
    {
        return Cache::rememberForever('larashopSocial', function () {
            return LarashopSocial::all();
        });
    }

    public function socialIcon(LarashopSocial $larashopSocial)
    {
        return '<ion-icon name="' . $larashopSocial->icon_name . '" size="large" class="' . $larashopSocial->icon_color . '" aria-label="' . $larashopSocial->name . '"></ion-icon>';
    }
}
