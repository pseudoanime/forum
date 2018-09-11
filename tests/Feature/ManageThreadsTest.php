<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Activity;

class ManageThreadsTest extends TestCase
{
    use RefreshDatabase;

    /**  @test * */
    public function guests_may_not_create_threads()
    {
        $this->post('/threads', [])
            ->assertRedirect('login');

        $this->get('/threads/create')
            ->assertRedirect('login');
    }

    /**  @test * */
    public function an_authenticated_user_may_create_threads()
    {
        $this->signIn();

        $channel = create('App\Channel');

        $thread = make('App\Thread', ['channel_id' => $channel->id]);

        $this->followingRedirects()
            ->post('/threads', $thread->toArray())
            ->assertSuccessful()
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /**  @test * */
    public function it_requires_a_title()
    {
        $this->check_validation(['title' => null]);
    }

    /**  @test * */
    public function it_requires_a_body()
    {
        $this->check_validation(['body' => null]);
    }

    /**  @test * */
    public function it_requires_a_valid_channel_id()
    {
        $this->check_validation(['channel_id' => null]);

        $this->check_validation(['channel_id' => PHP_INT_MAX]);

    }

    public function test_unauthorized_users_cannot_delete_thread()
    {
        $thread = create(Thread::class);

        $this->delete('/threads/' . $thread->id)
            ->assertRedirect("login");
    }

    public function test_only_owners_can_delete_threads()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $this->delete('/threads/' . $thread->id)
            ->assertForbidden();
    }

    public function test_a_thread_can_be_deleted()
    {
        $this->signIn();

        $thread = create(Thread::class, ['user_id' => auth()->id()]);

        $this->delete('/threads/' . $thread->id)
            ->assertRedirect();

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
    }


    public function test_deleting_thread_also_deletes_associated_replies()
    {
        $this->signIn();

        $thread = create(Thread::class, ['user_id' => auth()->id()]);

        create(Reply::class, ['thread_id' => $thread->id], rand(1, 10));

        $this->delete('/threads/' . $thread->id)
            ->assertRedirect();

        $this->assertCount(0, Activity::all());

    }

    protected function check_validation($testArray)
    {
        $this->signIn();

        $thread = factory('App\Thread')->make()->toArray();

        $this->post('/threads/', array_merge($thread, $testArray))
            ->assertSessionHasErrors(array_keys($testArray));
    }
}
