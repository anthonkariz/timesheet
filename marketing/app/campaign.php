<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class campaign extends Model
{
    //
     public $timestamps = false;

      public function clients()
    {
        return $this->hasMany('App\Clients');
    }
}
