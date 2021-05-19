<?php

namespace CobraProjects\LaraShop\Http\Controllers\Admin;

use CobraProjects\LaraShop\Facades\LaraShop;
use CobraProjects\LaraShop\Models\LarashopBrand;
use CobraProjects\LaraShop\Models\LarashopProduct;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class LarashopProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permitTo:ReadLarashopProduct')->only('index');
        $this->middleware('permitTo:CreateLarashopProduct')->only('create', 'store');
        $this->middleware('permitTo:UpdateLarashopProduct')->only('edit', 'update');
        $this->middleware('permitTo:DeleteLarashopProduct')->only('destroy', 'deleteMedia');
    }

    public function index()
    {
        $products = LaraShop::getAllProducts();
        return view('multiauth::product.index', compact('products'));
    }

    public function create()
    {
        $categories = LaraShop::getAllCategories();
        $brands     = LaraShopBrand::cursor();
        $order      = $categories->max('order') + 1;
        return view('multiauth::product.create', compact('categories', 'order', 'brands'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required',
            'slug'         => 'required|unique:larashop_products,slug',
            'description'  => 'required',
            'hidden'       => 'nullable',
            'categories'   => 'required',
            'hidden'       => 'nullable',
            'price'        => 'required|numeric',
            'old_price'    => 'nullable|numeric',
            'qty'          => 'nullable|numeric',
            'max_qty'      => 'nullable|numeric',
            'new'          => 'nullable',
            'featured'     => 'nullable',
            'has_discount' => 'nullable',
            'brand_id'     => 'nullable',
            'image'        => 'required|image|mimes:jpeg,png,jpg',
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

    public function edit(LarashopProduct $product)
    {
        $categories = LaraShop::getAllCategories();
        $brands     = LaraShopBrand::cursor();
        return view('multiauth::product.edit', compact('categories', 'product', 'brands'));
    }

    public function update(Request $request, LarashopProduct $product)
    {
        $data = $request->validate([
            'name'         => 'required',
            'slug'         => 'required|unique:larashop_products,slug,' . $product->id,
            'description'  => 'required',
            'hidden'       => 'nullable',
            'categories'   => 'required',
            'hidden'       => 'nullable',
            'price'        => 'required|numeric',
            'old_price'    => 'nullable|numeric',
            'qty'          => 'nullable|numeric',
            'max_qty'      => 'nullable|numeric',
            'new'          => 'nullable',
            'featured'     => 'nullable',
            'has_discount' => 'nullable',
            'brand_id'     => 'nullable',
            'image'        => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $product->update($data);

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

    public function destroy(LarashopProduct $product)
    {
        if ($product->hasChilds) {
            return back()->with('error', 'هذا المنتج يحتوي على منتجات فرعية .. برجاء نقلها او حذفها اولاَ...');
        }
        $product->delete();

        Cache::forget('allProducts');

        return back()->with('success', 'تم الحذف بنجاح');
    }

    public function deleteMedia(Media $media)
    {
        $media->delete();
        return back()->with('success', 'تم الحذف بنجاح');
    }
}
