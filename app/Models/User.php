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
        'name', 'email', 'password', 'activated' , 'email_token'
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

    public function scopeFilter($buider, QueryFilter $filters){
        return $filters->apply($buider);
    }

    public function activated()
    {
        $this->activated = 1;
        $this->email_token = null;
        $this->save();
    }
}
