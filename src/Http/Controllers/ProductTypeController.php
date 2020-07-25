<?php

namespace CobraProjects\LaraShop\Http\Controllers;

use Illuminate\Routing\Controller;

class ProductTypeController extends Controller
{
    public function index()
    {
        return view('larashop::productType.index');
    }
}
