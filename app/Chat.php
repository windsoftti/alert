<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Chat extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function lead()
    {
        return $this->belongsTo('App\Prospecto', 'lead_id');
    }
}
