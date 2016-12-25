<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class user extends Model implements Authenticatable
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

    public function comments()
    {
        return $this->hasMany('App\comment');
    }

    public function friendRequests()
    {
        return $this->hasMany('App\friendrequest', 'user_requested_id');
    }

    public function friendReceived()
    {
        return $this->hasMany('App\friendrequest', 'user_received_id');
    }

}
