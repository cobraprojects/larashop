<?php

namespace CobraProjects\LaraShop\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use CobraProjects\LaraShop\Models\LarashopSetting;

class LarashopSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permitTo:ReadLarashopSetting')->only('index');
        $this->middleware('permitTo:UpdateLarashopSetting')->only('store');
    }

    public function index()
    {
        $setting = LarashopSetting::first() ?? new LarashopSetting();
        return view('multiauth::setting.index', compact('setting'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable|max:1000',
            'phone' => 'required',
            'email' => 'required',
            'whatsapp' => 'nullable|numeric',
            'address' => 'nullable',
            'country_name' => 'nullable',
            'currency_name' => 'nullable',
            'currency_symbol' => 'nullable',
        ]);

        LarashopSetting::updateOrCreate(['id' => 1], $data);
        Cache::forget('larashopSettings');

        return back()->with('success', 'تم الحفظ بنجاح');
    }
}
