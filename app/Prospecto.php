<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Prospecto extends Model
{
    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function asignado()
    {
        return $this->belongsTo('App\User', 'asignado_id');
    }

    public function seguimiento()
    {
        return $this->belongsTo('App\Seguimiento', 'seguimiento_id');
    }
}
