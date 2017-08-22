<?php

namespace App\Http\Controllers;

use App\Events\TestEvent;
use App\Http\Requests\OrderItemRequest;
use App\Mail\OrderCreated;

use App\Notifications\AddOrderToKitchen;
use App\Notifications\EditOrderByKitchen;

use App\Models\Order;
use App\Models\User;
use App\Models\Filters\OrderFilter;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, OrderFilter $filters)
    {
        $orders = Order::filter($filters)->with('users')->where('status' , false)->get();
        $paginatedSearchResults = $this->paginate($orders, $request);
        return view('orders.index', ['orders' => $paginatedSearchResults]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('orders.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderItemRequest $request)
    {
        $input = $request->all();
        $order = Order::create($input);
        Auth::user()->assignOrder($order);

        $user = User::findOrFail(5);
        $user->notify(new AddOrderToKitchen($order));

        event( new TestEvent($order));
        Mail::to(Auth::user())->send(new OrderCreated($order));
        return redirect('/orders');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);

        return view('orders.edit')->with(compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderItemRequest $request, $id)
    {
        $order = Order::findOrFail($id);
        $input = $request->all();
        $order->fill($input)->save();

        $user = $order->users->first();
        $user->notify(new EditOrderByKitchen($order));

        return redirect('/orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
