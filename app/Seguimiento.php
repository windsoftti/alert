<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Seguimiento extends Model
{
    public function tipo()
    {
        return $this->belongsTo('App\Tipo','type_id');
    }
}
