<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index($sortingBy = null )
    {
        $key = "desc";

        if($sortingBy == NULL){
            $users = User::latest()->paginate(10);
        } else {
            $users = User::orderBy($sortingBy, $key)
                ->paginate(10);
        }

        return view('admin.index')->with(compact('users'));
    }
}
