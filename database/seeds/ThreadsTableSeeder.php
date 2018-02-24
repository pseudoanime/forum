<?php

use Illuminate\Database\Seeder;
use App\Thread;

class ThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Thread::class, 50)->create()->each(function($thread) {
            factory('App\Reply',10, ['thread_id' => $thread->id])->create();
        });
    }
}
