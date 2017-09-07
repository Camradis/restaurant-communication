<?php

namespace App\Http\Controllers\Order;

use App\Events\OrderCompleteEvent;
use App\Http\Controllers\Controller;
use App\Notifications\OrderCompleteByKitchen;
use App\Models\Order;
use Illuminate\Http\Request;

class CompletedOrderController extends Controller
{
    /**
     * Get completed orders
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')
            ->where('status', true)
            ->paginate(6);

        return view('orders.index')->with(compact('orders'));
    }

    /**
     * Update order status
     *
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $status = $order->status;

        event(new OrderCompleteEvent($order));

        $order->status = !$status;
        $order->save();

        $user = $order->users->first();

        $user->notify(new OrderCompleteByKitchen($order));

        $route_redirect = ($status == true ? '/orders/completed' : '/orders');

        return redirect($route_redirect);
    }
}
