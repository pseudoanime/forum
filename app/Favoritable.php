<?php namespace App;

use Log;

trait Favoritable
{
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

    public function isFavorited()
    {
        Log::debug(__METHOD__ . " : bof");

        return !!$this->favorites->where('user_id', auth()->id())->count();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->where('user_id', auth()->id())->count();
    }

}
