<?php

namespace CobraProjects\LaraShop\Http\Controllers\Admin;

use CobraProjects\LaraShop\Models\LarashopCity;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class LarashopCityController extends Controller
{
    public function index()
    {
        $cities = LarashopCity::cursor();
        return view('multiauth::city.index', compact('cities'));
    }

    public function create()
    {
        return view('multiauth::city.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'shipping_cost' => 'required|numeric',
        ]);

        $city = LarashopCity::create($data);

        return back()->with('success', 'تم الحفظ بنجاح');
    }

    public function edit(LarashopCity $city)
    {
        return view('multiauth::city.edit', compact('city'));
    }

    public function update(Request $request, LarashopCity $city)
    {
        $data = $request->validate([
            'name' => 'required',
            'shipping_cost' => 'required|numeric',
        ]);

        $city->update($data);

        return back()->with('success', 'تم الحفظ بنجاح');
    }


    public function destroy(LarashopCity $city)
    {
        $city->delete();

        return back()->with('success', 'تم الحذف بنجاح');
    }
}
