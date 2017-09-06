<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    /**
     * Paginate data, that isn`t Collection.
     *
     * @param $data
     * @param $request
     *
     * @return LengthAwarePaginator
     */
    public function paginate($data, $request){

        $collection = new Collection($data);
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 9;
        $currentPageSearchResults = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedSearchResults = new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
        $paginatedSearchResults->setPath($request->url());
        $paginatedSearchResults->appends($request->except(['page']));

        return $paginatedSearchResults;
    }

    /**
     * Get user, that is kitchen manager.
     *
     * @return Collection|\Illuminate\Database\Eloquent\Model
     */
    public function getKitchenManager() {
        $kitchen_manager = User::findOrFail(2);

        return $kitchen_manager;
    }
}
