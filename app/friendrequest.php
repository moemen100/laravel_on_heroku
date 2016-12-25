<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class friendrequest extends Model
{
    protected $fillable=[
        'user_requested_id','user_received_id','status'
    ];

    public function userReceived()
    {
        return $this->belongsTo('App\user','user_received_id');
    }
    public function userRequested()
    {
        return $this->belongsTo('App\user','user_requested_id');
    }
    
}
