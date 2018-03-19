<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['body', 'user_id'];

    public function thread()
    {
        return $this->belongsTo('App\Thread');
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function favorites()
    {
        return $this->morphMany('App\Favorite', 'favorited');
    }

    public function favorite()
    {
        $attributes = [
            'user_id' => auth()->id()
        ];

        if (!$this->favorites()->where('user_id', auth()->id())->exists()) {

            $this->favorites()->create($attributes);
        }
    }
}
