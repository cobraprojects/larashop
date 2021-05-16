<?php

namespace CobraProjects\LaraShop\Http\Controllers\Admin;

use CobraProjects\LaraShop\Models\LarashopBrand;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class LarashopBrandController extends Controller
{
    public function index()
    {
        $brands = LarashopBrand::cursor();
        return view('multiauth::brand.index', compact('brands'));
    }

    public function create()
    {
        return view('multiauth::brand.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:larashop_categories,slug',
        ]);

        $brand = LarashopBrand::create($data);

        if ($request->image) {
            $brand->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return back()->with('success', 'تم الحفظ بنجاح');
    }

    public function edit(LarashopBrand $brand)
    {
        return view('multiauth::brand.edit', compact('brand'));
    }

    public function update(Request $request, LarashopBrand $brand)
    {
        $data = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:larashop_categories,slug,' . $brand->id,
        ]);

        $brand->update($data);

        if ($request->image) {
            $brand->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return back()->with('success', 'تم الحفظ بنجاح');
    }


    public function destroy(LarashopBrand $brand)
    {
        $brand->delete();

        return back()->with('success', 'تم الحذف بنجاح');
    }
}
