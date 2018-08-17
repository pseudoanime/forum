<?php

namespace Tests\Unit;

use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
                'type'         => 'created thread',
                'subject_id'   => $thread->id,
                'subject_type' => get_class($thread)
            ]);
    }


}
