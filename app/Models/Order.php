<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Filters\QueryFilter;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = array('dish_name', 'status' , 'board');

    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }

    public function scopeFilter($buider, QueryFilter $filters){
        return $filters->apply($buider);
    }
}
