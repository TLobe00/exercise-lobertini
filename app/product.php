<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    protected $table = 'products';

    public function inventory()
    {
        return $this->hasOne('App\inventory');
    }

    public function comments()
    {
        return $this->hasMany('App\comments');
    }
}
