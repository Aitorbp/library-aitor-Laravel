<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    public function libro()
    {
        return $this->hasOne('App\Libro', 'foreingn_key');
    }
    public function user()
    {
        return $this->hasOne('App\User', 'foreingn_key');
    }
}
