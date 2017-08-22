<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Filters\UserFilter;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * @param UserFilter $filters
     * @return mixed
     */
    public function index(Request $request, UserFilter $filters)
    {
        $users = User::filter($filters)->get();
        $paginatedSearchResults = $this->paginate($users, $request);
        return view('admin.index', ['users' => $paginatedSearchResults]);
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
