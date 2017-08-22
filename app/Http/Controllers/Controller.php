<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * @param $data
     * @param $request
     * @return LengthAwarePaginator
     */
    public function paginate($data, $request){

        $collection = new Collection($data);
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 9;
        $currentPageSearchResults = $collection->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedSearchResults= new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);
        $paginatedSearchResults->setPath($request->url());
        $paginatedSearchResults->appends($request->except(['page']));
        return $paginatedSearchResults;
    }
}
