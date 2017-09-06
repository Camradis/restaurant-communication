<?php

namespace App\Models;

use App\Models\Filters\QueryFilter;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class User extends Authenticatable
{
    use Notifiable;
    use AuthenticableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'activated',
        'email_token',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * Retrieve role relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Determine if auth user role equals given role.
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasRole($name)
    {
        if ($this->role->name == $name) {
            return true;
        }
        return false;
    }

    /**
     * Assign user role.
     *
     * @param $role
     *
     * @return mixed
     */
    public function assignRole($role)
    {
        return $this->role()->associate($role)->save();
    }


    /**
     * Remove role from user.
     *
     * @return int
     */
    public function removeRole()
    {
        return $this->role()->dissociate();
    }

    /**
     * Retrieve order relations.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withTimestamps();
    }

    /**
     * Determine if auth user role equals given role.
     *
     * @param int $id
     *
     * @return bool
     */
    public function hasOrder($id)
    {
        foreach ($this->orders as $order) {
            if ($order->id == $id) return true;
        }

        return false;
    }

    /**
     * @param $order
     *
     * Assign order for user`s orders.
     */
    public function assignOrder($order)
    {
        return $this->orders()->attach($order);
    }

    /**
     * @param $order
     *
     * Remove given order from user`s orders.
     *
     * @return int
     */
    public function removeOrder($order)
    {
        return $this->orders()->detach($order);
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

    /**
     * Set user activated value true.
     *
     * Make user email_token equal null.
     */
    public function activated()
    {
        $this->activated = 1;
        $this->email_token = null;
        $this->save();
    }
}
