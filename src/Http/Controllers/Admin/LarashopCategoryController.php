<?php

namespace CobraProjects\LaraShop\Http\Controllers\Admin;

use CobraProjects\LaraShop\Facades\LaraShop;
use CobraProjects\LaraShop\Models\LarashopCategory;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class LarashopCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permitTo:ReadLarashopCategory')->only('index');
        $this->middleware('permitTo:CreateLarashopCategory')->only('create', 'store');
        $this->middleware('permitTo:UpdateLarashopCategory')->only('edit', 'update');
        $this->middleware('permitTo:DeleteLarashopCategory')->only('destroy');
    }

    public function index()
    {
        $categories = LaraShop::getAllCategories();
        return view('multiauth::category.index', compact('categories'));
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

        $category = LarashopCategory::create($data);

        if ($request->image) {
            $category->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return back()->with('success', 'تم الحفظ بنجاح');
    }

    public function edit(LarashopCategory $category)
    {
        $categories = LaraShop::getAllCategories();
        return view('multiauth::category.edit', compact('categories', 'category'));
    }

    public function update(Request $request, LarashopCategory $category)
    {
        $data = $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:larashop_categories,slug,' . $category->id,
            'parent_id' => 'nullable',
            'description' => 'nullable',
            'order' => 'required',
        ]);

        $category->update($data);

        if ($request->image) {
            $category->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return back()->with('success', 'تم الحفظ بنجاح');
    }


    public function destroy(LarashopCategory $category)
    {
        if ($category->hasChilds) {
            return back()->with('error', 'هذا القسم يحتوي على اقسام فرعية .. برجاء نقلها او حذفها اولاَ...');
        }
        $category->delete();

        return back()->with('success', 'تم الحذف بنجاح');
    }
}
