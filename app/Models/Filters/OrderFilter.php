<?php

namespace App\Models\Filters;

class OrderFilter extends QueryFilter
{
    /**
     * @param string $field
     * @return mixed
     */
    public function ascsorting($field = 'created_at')
    {
        return $this->builder->orderBy($field, 'ASC');
    }

    /**
     * @param string $field
     * @return mixed
     */
    public function descsorting($field = 'created_at')
    {
        return $this->builder->orderBy($field, 'DESC');
    }

    /**
     * @param $searchingName
     * @return mixed
     */
    public function dish($searchingName)
    {
        return $this->builder->where('dish_name', 'LIKE', '%' . $searchingName . '%');
    }

    /**
     * @param $boardNumber
     * @return mixed
     */
    public function board($boardNumber)
    {
        return $this->builder->where('board', $boardNumber);
    }

    /**
     * @param $orderStatus
     * @return mixed
     */
    public function status($orderStatus)
    {
        return $this->builder->where('status', $orderStatus);
    }

    /**
     * @param $searchingName
     * @return mixed
     */
    public function server($searchingName)
    {
        return $this->builder
            ->select('orders.*', 'order_user.user_id as server_id')
            ->join('order_user', 'orders.id', '=', 'order_user.order_id')
            ->join('users', 'order_user.user_id', '=', 'users.id')
            ->where('users.name', 'LIKE', '%' . $searchingName . '%');
    }
}