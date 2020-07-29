<?php

namespace CobraProjects\LaraShop\Http\Controllers\Admin;

use CobraProjects\LaraShop\Models\LarashopCategory;
use Illuminate\Routing\Controller;

class LarashopCategoryController extends Controller
{
    public function index()
    {
        $categories = LarashopCategory::all();
        return view('multiauth::category.index', compact('categories'));
    }
}
