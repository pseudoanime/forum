<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfilesTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_has_a_profile()
    {

        $user = create(User::class);

        $this->withoutExceptionHandling()->get("/profiles/{$user->name}")
            ->assertSee($user->name);
    }

    public function test_profiles_display_all_the_threads_associated_to_the_user()
    {

        $this->signIn();

        $thread = create(Thread::class, [
            'user_id' => auth()->id()
        ]);

        $this->withoutExceptionHandling()
            ->get("/profiles/" . auth()->user()->name)
            ->assertSee($thread->title)
            ->assertSee($thread->body);

    }
}
