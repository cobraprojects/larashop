<?php

namespace CobraProjects\LaraShop\Http\Controllers\Admin;

use CobraProjects\LaraShop\Models\LarashopOrder;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class LarashopOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permitTo:ReadLarashopOrder')->only('index', 'show');
    }

    public function index()
    {
        $orders = LarashopOrder::with('user', 'shippingAddress')->orderBy('created_at', 'DESC')->get();
        return view('multiauth::order.index', compact('orders'));
    }

    public function show(LarashopOrder $order)
    {
        $order->load('shippingAddress', 'user', 'details');
        return view('multiauth::order.show', compact('order'));
    }

    public function changePaymentStatus(Request $request, LarashopOrder $order)
    {
        $order->paid = $request->paid;
        $order->save();

        return back()->with('success', 'تم تغيير حالة السداد بنجاح');
    }

    public function changeOrderStatus(Request $request, LarashopOrder $order)
    {
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'تم تغيير حالة الطلب بنجاح');
    }
}
