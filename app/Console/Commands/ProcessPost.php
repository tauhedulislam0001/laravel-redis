<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class ProcessPost extends Command
{
    protected $signature = 'process:post';
    protected $description = 'Process posts in the Redis queue and store in MySQL.';
    public function handle()
    {
        $post_queue = 'post_queue';
        $post_queue_processed = 'post_queue_processed';
        while (true) {
            $post_data = Redis::brpoplpush($post_queue, $post_queue_processed, 0);

            $post = new Post();
            $post->fill(json_decode($post_data, true));
            $post->save();

            Redis::lrem($post_queue_processed, 0, $post_data);
        }
    }
}
