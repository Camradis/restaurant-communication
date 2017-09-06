<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Retrieve user relation.
     *
     * @return mixed
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
