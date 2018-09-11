<?php

namespace Tests\Unit;

use App\Activity;
use App\Reply;
use App\Thread;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_records_activity_when_a_thread_is_created()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $this->withoutExceptionHandling()
            ->assertDatabaseHas('activities', [
                'user_id'      => auth()->id(),
                'type'         => 'created_thread',
                'subject_id'   => $thread->id,
                'subject_type' => get_class($thread)
            ]);

        $activity = Activity::first();

        $this->assertEquals($activity->subject->id, $thread->id);
    }

    public function test_it_records_activity_when_a_reply_is_created()
    {
        $this->signIn();

        $reply = create(Reply::class);

        $this->assertCount(2, Activity::all());

        $this->withoutExceptionHandling()
            ->assertDatabaseHas('activities', [
                'user_id'      => auth()->id(),
                'type'         => 'created_reply',
                'subject_id'   => $reply->id,
                'subject_type' => get_class($reply)
            ]);

        $activity = Activity::first();

        $this->assertEquals($activity->subject->id, $reply->id);
    }

    public function test_it_fetches_a_feed_for_any_user()
    {
        $this->signIn();

        create(Thread::class, ['user_id' => auth()->id()], 2);

        auth()->user()->activity()->first()->update(['created_at' => Carbon::now()->subWeek()]);

        $feed = Activity::feed(auth()->user());

        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->format("Y-m-d")
        ));

        $this->assertTrue($feed->keys()->contains(
            Carbon::now()->subWeek()->format("Y-m-d")
        ));

    }


}
