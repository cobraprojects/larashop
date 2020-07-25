<?php

namespace CobraProjects\LaraShop\Http\Controllers\Admin;

use Illuminate\Routing\Controller;

class ProductTypeController extends Controller
{
    public function index()
    {
        return view('larashop::admin.productType.index');
    }
}
