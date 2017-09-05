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
     * Get all users
     *
     * @param Request $request
     * @param UserFilter $filters
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, UserFilter $filters)
    {
        $users = User::filter($filters)->get();
        $paginatedSearchResults = $this->paginate($users, $request);

        return view('admin.index', ['users' => $paginatedSearchResults]);
    }

    /**
     * Get route for searching request
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function search(Request $request)
    {
        $path = 'http://localhost:8000/admin/users';

        if ($request->input('name') && $request->input('email')) {
            $path = $path . '?name=' . $request->input('name') . '&email=' . $request->input('email');
        } else if ($request->input('email')) {
            $path = $path . '?email=' . $request->input('email');
        } else if ($request->input('name')) {
            $path = $path . '?name=' . $request->input('name');
        }

        return Redirect::to($path);
    }
}
