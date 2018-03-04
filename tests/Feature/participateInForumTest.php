<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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

        $this->followingRedirects()
            ->post($this->thread->path() . '/replies', $reply->toArray())
            ->assertSee($reply->body);
    }

    /**  @test **/
    public function unauthenticated_users_may_not_post_replies()
    {
        $this->post($this->thread->path() . '/replies', [])
            ->assertRedirect('login');
    }

    /**  @test **/
    public function a_reply_requires_a_body()
    {
          $this->signIn();

          $this->post($this->thread->path().'/replies', ['body'=> null])
          ->assertSessionHasErrors('body');
    }
}
