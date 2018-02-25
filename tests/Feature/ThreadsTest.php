<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadsTest extends TestCase
{
    use RefreshDatabase;

   /**  @test **/
   public function a_user_can_view_threads()
   {
        $thread = factory('App\Thread')->create();

        $this->get('/threads')
            ->assertSee($thread->title);

        $this->get('/threads/' . $thread->id)
            ->assertSee($thread->title);
   }
}
