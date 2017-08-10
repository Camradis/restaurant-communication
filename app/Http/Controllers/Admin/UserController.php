<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $key = $request->input('key');
        $field = $request->input('sortingBy');

        if($field == NULL || $key == NULL){
            $users = User::latest()->paginate(10);
        } else {

            $users = User::orderBy($field, $key)
                ->paginate(10);
        }

        return view('admin.index')->with(compact('users'));
    }
}
