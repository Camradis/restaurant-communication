<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderItemRequest;
use App\Mail\OrderCreated;
use App\Mail\OrderUpdated;
use App\Notifications\AddOrderToKitchen;
use App\Notifications\EditOrderByKitchen;
use App\Models\Order;
use App\Models\User;
use App\Models\Filters\OrderFilter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Events\TestEvent;

class OrderController extends Controller
{
    /**
     * Get orders
     *
     * @param Request $request
     * @param OrderFilter $filters
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, OrderFilter $filters)
    {
        $orders = Order::filter($filters)
            ->with('users')
            ->where('status', false)
            ->get();

        $paginatedSearchResults = $this->paginate($orders, $request);

        return view('orders.index', ['orders' => $paginatedSearchResults]);
    }

    /**
     * Show the form for creating a new order.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Create an order.
     *
     * @param OrderItemRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(OrderItemRequest $request)
    {
        $order = Order::create($request->all());
        Auth::user()->assignOrder($order);

        $user = User::findOrFail(4);
        $user->notify(new AddOrderToKitchen($order));

        event(new TestEvent($order));
        Mail::to(Auth::user())->send(new OrderCreated($order));

        return redirect('/orders');
    }

    /**
     * Display the specified order.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);

        return view('orders.show')->with(compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('orders.edit')->with(compact('order'));
    }


    /**
     * Update order information
     *
     * @param OrderItemRequest $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(OrderItemRequest $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->fill($request->all())->save();

        $user = $order->users->first();
        $user->notify(new EditOrderByKitchen($order));

        Mail::to($user)->send(new OrderUpdated($order));

        return redirect('/orders');
    }
}
