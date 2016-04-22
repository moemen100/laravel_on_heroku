<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\authenticatable;

class user extends Model  implements authenticatable
{
    use \ Illuminate\Auth\authenticatable;

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

}
