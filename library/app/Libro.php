<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    public function usuario()
    {
        return $this->hasMany('App\User');
    }
}
