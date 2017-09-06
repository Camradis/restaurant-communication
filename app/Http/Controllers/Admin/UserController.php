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
        $data = $request->except('_token');
        $path = $this->getPathUrl($data);

        return Redirect::to($path);
    }

    /**
     * Get filtered data.
     *
     * @param $data
     *
     * @return array
     */
    public function getFilteredData($data) {
        $filtered_data = array_filter(
            $data,
            create_function(
                '$a',
                'return $a !== null;'
            )
        );
        return $filtered_data;
    }


    /**
     * Get searching path url.
     *
     * @param $data
     *
     * @return string
     */
    public function getPathUrl($data) {
        $path = 'http://localhost:8000/admin/users';
        $filtered_data = $this->getFilteredData($data);

        $index = 0;
        foreach ( $filtered_data as $key => $value) {
            if($index == 0) {
                $path = "$path?$key=$value";

                $index++;
            } else {
                $path = "$path&$key=$value";
            }
        }

        return $path;
    }
}
