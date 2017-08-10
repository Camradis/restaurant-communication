<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10.08.17
 * Time: 11:41
 */

namespace App\Models\Filters;

class UserFilter extends QueryFilter
{
    public function time($orderType = 'desc'){
        return $this->builder->orderBy('created_at' , $orderType);
    }

    public function name($searchingName){
        return $this->builder->where('name' , 'LIKE' , '%' . $searchingName . '%');
    }

}