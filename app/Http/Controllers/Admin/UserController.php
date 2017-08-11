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
        //Get current page form url e.g. &page=6
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        //Create a new Laravel collection from the array data
        $collection = new Collection($users);

        //Define how many items we want to be visible in each page
        $perPage = 3;


        //Slice the collection to get the items to display in current page
        $currentPageSearchResults = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();

        //Create our paginator and pass it to the view
        $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
        $paginatedSearchResults->setPath($request->url());
        $paginatedSearchResults->appends($request->except(['page']));
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
