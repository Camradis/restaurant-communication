<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Filters\UserFilter;

class UserController extends Controller
{
    /**
     * @param UserFilter $filters
     * @return mixed
     */
    public function index(UserFilter $filters)
    {
        return User::filter($filters)->get();
//        $key = $request->input('key');
//        $field = $request->input('sortingBy');
//
//        if($field == NULL || $key == NULL){
//            $users = User::latest()->paginate(10);
//        } else {
//
//            $users = User::orderBy($field, $key)
//                ->paginate(10);
//        }
//
//        return view('admin.index')->with(compact('users'));
    }
}
