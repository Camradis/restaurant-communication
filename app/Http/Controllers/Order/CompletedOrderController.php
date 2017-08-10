<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Notifications\OrderCompleteByKitchen;
use Illuminate\Http\Request;
use App\Models\Order;

class CompletedOrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->where('status', '=', true )->paginate(6);
        return view('orders.index')->with(compact('orders'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $status = $order->status;
        $order->status = !$status;
        $order->save();
        $user = $order->users->first();
        $user->notify(new OrderCompleteByKitchen($order));
        return redirect('/orders');
    }
}
