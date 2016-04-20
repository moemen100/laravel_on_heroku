<?php

namespace App;
use Illuminate\Contracts\Auth\authenticatable;
use Illuminate\Database\Eloquent\Model;

class user extends Model implements authenticatable
{
   use \ Illuminate\Auth\authenticatable; 
}
