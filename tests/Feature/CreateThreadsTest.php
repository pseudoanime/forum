<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use RefreshDatabase;

    /**  @test **/
    public function guests_cannot_see_the_create_threads_page()
    {

        $this->get( '/threads/create')
        ->assertRedirect('login');
    }

    /**  @test **/
    public function guests_may_not_create_threads()
    {
         $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->followingRedirects()
        ->withoutExceptionHandling()
            ->post( '/threads',[]);
    }

    /**  @test **/
    public function an_authenticated_user_may_create_threads()
    {
        $this->signIn();

        $thread = make('App\Thread');

        $this->followingRedirects()
        ->post('/threads', $thread->toArray())
        ->assertSee($thread->title)
        ->assertSee($thread->body);
    }
}
