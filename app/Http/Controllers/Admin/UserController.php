<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Filters\UserFilter;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * @param UserFilter $filters
     * @return mixed
     */
    public function index(UserFilter $filters)
    {
        $users = User::filter($filters)->get();
        return view('admin.index')->with(compact('users'));
    }

    public function store(Request $request)
    {
        if ($request->input('name') && $request->input('email')) {
            $path = 'http://localhost:8000/admin/users?name=' . $request->input('name').'&email='.$request->input('email');
        } else if ($request->input('email')) {
            $path = 'http://localhost:8000/admin/users?email=' . $request->input('email');
        } else if ($request->input('name')) {
            $path = 'http://localhost:8000/admin/users?name=' . $request->input('name');
        } else {
            $path = 'http://localhost:8000/admin/users';
        }
        return Redirect::to($path);
    }
}
