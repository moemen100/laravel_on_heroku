<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{

    protected $fillable = [
        'user_id',
        'notification',
        'type',
        'read',
        'url',
        'message',
        'icon'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
