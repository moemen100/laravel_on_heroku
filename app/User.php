<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class user extends Model  implements Authenticatable
{
    use \ Illuminate\Auth\Authenticatable;

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function likes()
    {
        return $this->hasMany('App\like');
    }

}
