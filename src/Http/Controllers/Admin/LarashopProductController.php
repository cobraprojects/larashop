<?php

namespace CobraProjects\LaraShop\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use CobraProjects\LaraShop\Facades\LaraShop;
use CobraProjects\LaraShop\Models\LarashopProduct;
use CobraProjects\LaraShop\Models\LarashopBrand;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class LarashopProductController extends Controller
{
    public function index()
    {
        $products = LaraShop::getAllProducts();
        return view('multiauth::product.index', compact('products'));
    }

    public function create()
    {
        $categories = LaraShop::getAllCategories();
        $brands = LaraShopBrand::cursor();
        $order = $categories->max('order') + 1;
        return view('multiauth::product.create', compact('categories', 'order', 'brands'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:larashop_products,slug',
            'description' => 'required',
            'hidden' => 'nullable',
            'categories' => 'required',
            'hidden' => 'nullable',
            'price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
            'qty' => 'nullable|numeric',
            'max_qty' => 'nullable|numeric',
            'new' => 'nullable',
            'featured' => 'nullable',
            'has_discount' => 'nullable',
            'brand_id' => 'nullable'
        ]);

        $product = LarashopProduct::create($data);

        if ($request->image) {
            $product->addMediaFromRequest('image')->toMediaCollection('main');
        }

        if ($request->images) {
            $product->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('images');
                });
        }

        $product->larashopCategories()->sync($request->categories);

        Cache::forget('allProducts');

        return back()->with('success', 'تم الحفظ بنجاح');
    }

    public function edit(LarashopProduct $larashopProduct)
    {
        $categories = LaraShop::getAllCategories();
        $brands = LaraShopBrand::cursor();
        return view('multiauth::product.edit', compact('categories', 'larashopProduct', 'brands'));
    }

    public function update(Request $request, LarashopProduct $larashopProduct)
    {
        $data = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:larashop_products,slug,' . $larashopProduct->id,
            'description' => 'required',
            'hidden' => 'nullable',
            'categories' => 'required',
            'hidden' => 'nullable',
            'price' => 'required|numeric',
            'old_price' => 'nullable|numeric',
            'qty' => 'nullable|numeric',
            'max_qty' => 'nullable|numeric',
            'new' => 'nullable',
            'featured' => 'nullable',
            'has_discount' => 'nullable',
            'brand_id' => 'nullable',
        ]);

        $larashopProduct->update($data);

        if ($request->image) {
            $larashopProduct->addMediaFromRequest('image')->toMediaCollection('main');
        }

        if ($request->images) {
            $larashopProduct->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('images');
                });
        }

        $larashopProduct->larashopCategories()->sync($request->categories);

        Cache::forget('allProducts');

        return back()->with('success', 'تم الحفظ بنجاح');
    }


    public function destroy(LarashopProduct $larashopProduct)
    {
        if ($larashopProduct->hasChilds) {
            return back()->with('error', 'هذا المنتج يحتوي على منتجات فرعية .. برجاء نقلها او حذفها اولاَ...');
        }
        $larashopProduct->delete();

        Cache::forget('allProducts');

        return back()->with('success', 'تم الحذف بنجاح');
    }

    public function deleteMedia(Media $media)
    {
        $media->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }
}
