<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;

class Reply extends Model
{
    use Favoritable;

    protected $fillable = ['body', 'user_id'];

    protected $with = ['owner', 'favorites'];

    public function thread()
    {
        return $this->belongsTo('App\Thread');
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
