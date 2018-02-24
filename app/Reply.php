<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public function Thread()
    {
        return $this->belongsTo('App\Thread');
    }
}
