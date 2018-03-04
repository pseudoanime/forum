<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->thread = create('App\Thread');
    }

    /**  @test **/
    public function a_user_can_view_threads()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    /**  @test **/
    public function user_can_read_a_single_thread()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /**  @test **/
    public function user_can_read_replies_associated_with_a_thread()
    {
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    /**  @test **/
    public function a_user_can_filter_threads_according_to_a_channel()
    {
        $channel = create('App\Channel');

        $channelThread = create('App\Thread', ['channel_id' => $channel->id]);

        $nonChannelThread = create('App\Thread');

        $this->get('threads/' . $channel->slug)
            ->assertSee($channelThread->title)
            ->assertDontSee($nonChannelThread->title);
    }
}
