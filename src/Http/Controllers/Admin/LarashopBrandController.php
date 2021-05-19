<?php

namespace CobraProjects\LaraShop\Http\Controllers\Admin;

use CobraProjects\LaraShop\Models\LarashopBrand;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LarashopBrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('permitTo:ReadLarashopBrand')->only('index');
        $this->middleware('permitTo:CreateLarashopBrand')->only('create', 'store');
        $this->middleware('permitTo:UpdateLarashopBrand')->only('edit', 'update');
        $this->middleware('permitTo:DeleteLarashopBrand')->only('destroy');
    }

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
            'name'  => 'required',
            'slug'  => 'required|unique:larashop_categories,slug',
            'image' => 'required|image|mimes:jpeg,png,jpg',
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
            'name'  => 'required',
            'slug'  => 'required|unique:larashop_categories,slug,' . $brand->id,
            'image' => 'required|image|mimes:jpeg,png,jpg',
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
