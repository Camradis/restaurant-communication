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
    public function ascsorting($field = 'created_at'){
        return $this->builder->orderBy($field , 'ASC');
    }

    public function descsorting($field = 'created_at'){
        return $this->builder->orderBy($field , 'DESC');
    }



    public function registered($orderType = 'desc'){
        return $this->builder->orderBy('created_at' , $orderType);
    }

    public function name($searchingName){
        return $this->builder->where('name' , 'LIKE' , '%' . $searchingName . '%');
    }

    public function email($searchingEmail){
        return $this->builder->where('email' , 'LIKE' , '%' . $searchingEmail . '%');
    }

}