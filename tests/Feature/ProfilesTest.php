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
    
    public function test_profiles_display_all_the_threads_associated_to_the_user() {

        $user = create(User::class);

        $thread = create(Thread::class,[
            'user_id' => $user->id
        ]);

        $this->withoutExceptionHandling()
            ->get("/profiles/{$user->name}")
            ->assertSee($thread->title);

    }
}
