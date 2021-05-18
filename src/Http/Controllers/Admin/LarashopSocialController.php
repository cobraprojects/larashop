<?php

namespace CobraProjects\LaraShop\Http\Controllers\Admin;

use CobraProjects\LaraShop\Models\LarashopSocial;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class LarashopSocialController extends Controller
{
    public function __construct()
    {
        $this->middleware('permitTo:ReadLarashopSocial')->only('index');
        $this->middleware('permitTo:CreateLarashopSocial')->only('create', 'store');
        $this->middleware('permitTo:UpdateLarashopSocial')->only('edit', 'update');
        $this->middleware('permitTo:DeleteLarashopSocial')->only('destroy');
    }

    public function index()
    {
        $socials = LarashopSocial::cursor();
        return view('multiauth::social.index', compact('socials'));
    }

    public function create()
    {
        return view('multiauth::social.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'url' => 'required|url',
            'icon_name' => 'required',
            'icon_color' => 'nullable',
        ]);

        $social = LarashopSocial::create($data);

        return back()->with('success', 'تم الحفظ بنجاح');
    }

    public function edit(LarashopSocial $social)
    {
        return view('multiauth::social.edit', compact('social'));
    }

    public function update(Request $request, LarashopSocial $social)
    {
        $data = $request->validate([
            'name' => 'required',
            'url' => 'required|url',
            'icon_name' => 'required',
            'icon_color' => 'nullable',
        ]);

        $social->update($data);

        return back()->with('success', 'تم الحفظ بنجاح');
    }


    public function destroy(LarashopSocial $social)
    {
        $social->delete();

        return back()->with('success', 'تم الحذف بنجاح');
    }
}
