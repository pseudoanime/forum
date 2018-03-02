<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class participateInForumTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->thread = create('App\Thread');
    }

    /**  @test **/
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $user = create('App\User');

        $this->signIn();

        $reply = make('App\Reply');

        $this ->followingRedirects()
            ->post($this->thread->path() . '/replies', $reply->toArray())
            ->assertSee($reply->body);
    }

    /**  @test **/
    public function unauthenticated_users_may_not_post_replies()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->followingRedirects()
            ->withoutExceptionHandling()
            ->post($this->thread->path() . '/replies',[]);
    }
}
