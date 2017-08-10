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
        $users = User::filter($filters)->get();
        return view('admin.index')->with(compact('users'));
    }
}
