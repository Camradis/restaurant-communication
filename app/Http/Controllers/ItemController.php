<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Events\TestEvent;

class ItemController extends Controller
{
    public function index(){
        $items = Order::all();
        return view('test' , compact('items'));
    }

    public function postItem(Request $request){
        $item = Item::create($request->all());
        event( new TestEvent($item));
        return redirect()->back();
    }
}
