<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Channel;

class CreateThreadsTest extends TestCase
{
    use RefreshDatabase;

    /**  @test **/
    public function guests_may_not_create_threads()
    {
        $this->post('/threads', [])
            ->assertRedirect('login');

        $this->get('/threads/create')
            ->assertRedirect('login');
    }

    /**  @test **/
    public function an_authenticated_user_may_create_threads()
    {
        $this->signIn();

        $channel =  create('App\Channel');

        $thread = make('App\Thread', ['channel_id' => $channel->id]);

        $this->followingRedirects()
            ->post('/threads', $thread->toArray())
            ->assertSuccessful()
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /**  @test **/
    public function it_requires_a_title()
    {
        $this->check_validation(['title' => null]);
    }

     /**  @test **/
    public function it_requires_a_body()
    {
        $this->check_validation(['body' => null]);
    }

     /**  @test **/
    public function it_requires_a_valid_channel_id()
    {
        $this->check_validation(['channel_id' => null]);

        $this->check_validation(['channel_id' => PHP_INT_MAX]);
     
    }

    protected function check_validation($testArray)
    {
        $this->signIn();

        $thread =  factory('App\Thread')->make()->toArray();

        $this->post('/threads/', array_merge($thread, $testArray))
            ->assertSessionHasErrors(array_keys($testArray));
    }
}
