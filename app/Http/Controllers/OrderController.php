<?php

namespace App\Http\Controllers;

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
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, OrderFilter $filters)
    {
        $orders = Order::filter($filters)->with('users')->get();

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        //Create a new Laravel collection from the array data
        $collection = new Collection($orders);

        //Define how many items we want to be visible in each page
        $perPage = 3;


        //Slice the collection to get the items to display in current page
        $currentPageSearchResults = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();

        //Create our paginator and pass it to the view
        $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
        $paginatedSearchResults->setPath($request->url());
        $paginatedSearchResults->appends($request->except(['page']));
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
