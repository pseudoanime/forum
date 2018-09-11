<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Activity
 *
 * @package App
 */
class Activity extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * subject
     *
     * @return mixed
     */
    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * scopeFeed
     *
     * @param $user
     * @param $take
     *
     * @return
     */
    public static function feed($user, $take = 50)
    {
        return static::where('user_id', $user->id)
            ->with('subject')
            ->take($take)
            ->get()
            ->groupBy(function ($activity) {
                return $activity->created_at->format('Y-m-d');
            });
    }
}
