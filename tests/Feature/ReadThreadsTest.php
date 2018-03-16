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

    /**  @test * */
    public function a_user_can_view_threads()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    /**  @test * */
    public function user_can_read_a_single_thread()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /**  @test * */
    public function user_can_read_replies_associated_with_a_thread()
    {
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    /**  @test * */
    public function a_user_can_filter_threads_according_to_a_channel()
    {
        $channel = create('App\Channel');

        $channelThread = create('App\Thread', ['channel_id' => $channel->id]);

        $nonChannelThread = create('App\Thread');

        $this->get('threads/' . $channel->slug)
            ->assertSee($channelThread->title)
            ->assertDontSee($nonChannelThread->title);
    }

    /**  @test * */
    public function a_user_can_filter_threads_based_on_any_username()
    {
        $this->signIn();

        $thread = create('App\Thread', ['user_id' => auth()->id()]);

        $nonUserThread = create('App\Thread');

        $this->get('/threads/?by=' . auth()->user()->name)
            ->assertSee($thread->title)
            ->assertDontSee($nonUserThread->title);
    }

    /** @test * */
    public function a_user_can_filter_threads_by_popularity()
    {
        $threadWithThreeReplies = create('App\Thread');

        create('App\Reply', ['thread_id' => $threadWithThreeReplies->id], 3);

        $threadWithTwoReplies = create('App\Thread');

        create('App\Reply', ['thread_id' => $threadWithTwoReplies->id], 2);

        $response = $this->get("/threads?popular=1");

        $threadsFromResponse = $response->baseResponse->original->getData()['threads'];

        $this->assertEquals([3, 2, 0], $threadsFromResponse->pluck('replies_count')->toArray());

    }
}
