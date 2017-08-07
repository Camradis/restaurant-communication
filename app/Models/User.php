<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }

    public function hasRole($name)
    {
        foreach($this->roles as $role)
        {
            if($role->name == $name) return true;
        }

        return false;
    }

    public function assignRole($role)
    {
        return $this->roles()->attach($role);
    }

    public function removeRole($role)
    {
        return $this->roles()->detach($role);
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order')->withTimestamps();
    }

    public function hasOrder($id)
    {
        foreach($this->orders as $order)
        {
            if($order->id == $id) return true;
        }

        return false;
    }

    public function assignOrder($order)
    {
        return $this->orders()->attach($order);
    }

    public function removeOrder($order)
    {
        return $this->orders()->detach($order);
    }

}
