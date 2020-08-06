<?php

namespace CobraProjects\LaraShop\Http\Controllers\Admin;

use CobraProjects\LaraShop\Facades\LaraShop;
use CobraProjects\LaraShop\Models\LarashopProduct;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class LarashopProductController extends Controller
{
    public function index()
    {
        $products = LaraShop::getAllProducts();
        $categories = LaraShop::getAllCategories();
        return view('multiauth::category.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = LaraShop::getAllCategories();
        $order = $categories->max('order') + 1;
        return view('multiauth::category.create', compact('categories', 'order'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:larashop_categories,slug',
            'parent_id' => 'nullable',
            'description' => 'nullable',
            'order' => 'required',
        ]);

        $category = LarashopProduct::create($data);

        if ($request->image) {
            $category->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return back()->with('success', 'تم الحفظ بنجاح');
    }

    public function edit(LarashopProduct $larashopProduct)
    {
        $categories = LaraShop::getAllCategories();
        return view('multiauth::category.edit', compact('categories', 'larashopProduct'));
    }

    public function update(Request $request, LarashopProduct $larashopProduct)
    {
        $data = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:larashop_categories,slug,' . $larashopProduct->id,
            'parent_id' => 'nullable',
            'description' => 'nullable',
            'order' => 'required',
        ]);

        $larashopProduct->update($data);

        if ($request->image) {
            $larashopProduct->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return back()->with('success', 'تم الحفظ بنجاح');
    }


    public function destroy(LarashopProduct $larashopProduct)
    {
        if ($larashopProduct->hasChilds) {
            return back()->with('error', 'هذا القسم يحتوي على اقسام فرعية .. برجاء نقلها او حذفها اولاَ...');
        }
        $larashopProduct->delete();

        return back()->with('success', 'تم الحذف بنجاح');
    }
}
