<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10.08.17
 * Time: 11:41
 */

namespace App\Models\Filters;

class OrderFilter extends QueryFilter
{
    public function ascsorting($field = 'created_at'){
        return $this->builder->orderBy($field , 'ASC');
    }

    public function descsorting($field = 'created_at'){
        return $this->builder->orderBy($field , 'DESC');
    }

    public function dish($searchingName){
        return $this->builder->where('dish_name' , 'LIKE' , '%' . $searchingName . '%');
    }

    public function board($boardNumber){
        return $this->builder->where('board' , $boardNumber);
    }

    public function status($orderStatus){
        return $this->builder->where('status' , $orderStatus);
    }

    public function server($searchingName){
        return $this->builder
            ->select('orders.*', 'order_user.user_id as server_id')
            ->join('order_user', 'orders.id', '=', 'order_user.order_id')
            ->join('users', 'order_user.user_id', '=', 'users.id')
            ->where('users.name' , 'LIKE' , '%' . $searchingName . '%');
    }

}