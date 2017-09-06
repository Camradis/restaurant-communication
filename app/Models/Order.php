<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Filters\QueryFilter;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dish_name',
        'status',
        'board'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at',
        'deleted_at'
    ];

    /**
     * Retrieve user relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * @param QueryFilter $filters
     * @param $builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($builder, QueryFilter $filters)
    {
        return $filters->apply($builder);
    }
}
