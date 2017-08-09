<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class CompletedOrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->where('status', '=', true )->get();
        return view('orders.index')->with(compact('orders'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $status = $order->status;
        $order->status = !$status;
        $order->save();

        return redirect('/orders');
    }
}
