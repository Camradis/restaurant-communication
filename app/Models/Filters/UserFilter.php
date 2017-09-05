<?php

namespace App\Models\Filters;

class UserFilter extends QueryFilter
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
     * @param string $orderType
     * @return mixed
     */
    public function registered($orderType = 'desc')
    {
        return $this->builder->orderBy('created_at', $orderType);
    }

    /**
     * @param $searchingName
     * @return mixed
     */
    public function name($searchingName)
    {
        return $this->builder->where('name', 'LIKE', '%' . $searchingName . '%');
    }

    /**
     * @param $searchingEmail
     * @return mixed
     */
    public function email($searchingEmail)
    {
        return $this->builder->where('email', 'LIKE', '%' . $searchingEmail . '%');
    }
}