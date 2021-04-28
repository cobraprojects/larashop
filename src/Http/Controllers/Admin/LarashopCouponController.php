<?php

namespace CobraProjects\LaraShop\Http\Controllers\Admin;

use CobraProjects\LaraShop\Models\LarashopCategory;
use CobraProjects\LaraShop\Models\LarashopCoupon;
use CobraProjects\LaraShop\Models\LarashopProduct;
use Illuminate\Foundation\Auth\User;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class LarashopCouponController extends Controller
{
    public function index()
    {
        $coupons = LarashopCoupon::cursor();
        return view('multiauth::coupon.index', compact('coupons'));
    }

    public function create()
    {
        $categories = LarashopCategory::cursor();
        $products = LarashopProduct::where('hidden', 0)->cursor();
        $users = User::cursor();

        return view('multiauth::coupon.create', compact('categories', 'products', 'users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|unique:larashop_coupons,code',
            'descripiton' => 'nullable',
            'coupon_type' => 'required',
            'amount' => 'required|numeric',
            'discount_type' => 'nullable',
            'only_once' => 'nullable',
            'is_valid' => 'nullable',
            'expire_at' => 'nullable',
            'data' => 'nullable',
        ]);

        LarashopCoupon::create($data);

        return back()->with('success', 'تم الحفظ بنجاح');
    }

    public function edit(LarashopCoupon $larashopCoupon)
    {
        $categories = LarashopCategory::cursor();
        $products = LarashopProduct::where('hidden', 0)->cursor();
        $users = User::cursor();

        return view('multiauth::coupon.edit', compact('larashopCoupon', 'categories', 'products', 'users'));
    }

    public function update(Request $request, LarashopCoupon $larashopCoupon)
    {
        $data = $request->validate([
            'code' => 'required|unique:larashop_coupons,code,' . $larashopCoupon->id,
            'descripiton' => 'nullable',
            'coupon_type' => 'required',
            'amount' => 'required|numeric',
            'discount_type' => 'nullable',
            'only_once' => 'nullable',
            'is_valid' => 'nullable',
            'expire_at' => 'nullable',
            'data' => 'nullable',
        ]);

        $larashopCoupon->update($data);

        return back()->with('success', 'تم الحفظ بنجاح');
    }


    public function destroy(LarashopCoupon $larashopCoupon)
    {
        $larashopCoupon->delete();

        return back()->with('success', 'تم الحذف بنجاح');
    }
}
