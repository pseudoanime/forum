<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;

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
        Log::debug(__METHOD__ . " :bof");

        $attributes = [
            'user_id' => auth()->id()
        ];

        if (!$this->isFavorited()) {

            $this->favorites()->create($attributes);
        }
    }

    /**
     * @return bool
     */
    public function isFavorited()
    {
        Log::debug(__METHOD__ . " :bof");

        return $this->favorites()->where('user_id', auth()->id())->exists();
    }
}
