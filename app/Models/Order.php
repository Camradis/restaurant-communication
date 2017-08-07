<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = array('dish_name', 'status');

    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }
}
