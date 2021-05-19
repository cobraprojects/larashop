<?php

namespace CobraProjects\LaraShop\Http\Controllers\Admin;

use CobraProjects\LaraShop\Facades\LaraShop;
use CobraProjects\LaraShop\Models\LarashopPage;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class LarashopPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permitTo:ReadLarashopPage')->only('index');
        $this->middleware('permitTo:CreateLarashopPage')->only('create', 'store');
        $this->middleware('permitTo:UpdateLarashopPage')->only('edit', 'update');
        $this->middleware('permitTo:DeleteLarashopPage')->only('destroy');
    }

    public function index()
    {
        $pages = LarashopPage::cursor();
        return view('multiauth::page.index', compact('pages'));
    }

    public function create()
    {
        return view('multiauth::page.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:larashop_pages,slug',
            'sub_title' => 'nullable',
            'body' => 'required',
        ]);

        $page = LarashopPage::create($data);

        return back()->with('success', 'تم الحفظ بنجاح');
    }

    public function edit(LarashopPage $page)
    {
        return view('multiauth::page.edit', compact('page'));
    }

    public function update(Request $request, LarashopPage $page)
    {
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:larashop_pages,slug,' . $page->id,
            'sub_title' => 'nullable',
            'body' => 'required',
        ]);

        $page->update($data);

        return back()->with('success', 'تم الحفظ بنجاح');
    }


    public function destroy(LarashopPage $page)
    {
        $page->delete();

        return back()->with('success', 'تم الحذف بنجاح');
    }
}
