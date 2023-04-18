<?php

namespace App\Http\Controllers;

use App\Jobs\PostQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Cache::remember('posts', 60, function () {
            return Post::latest()->get();
        });

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $post = new Post;
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        $redis = Redis::lpush('posts', $post->toJson());

        // Enqueue job to insert data in MySQL
        PostQueue::dispatch($post->toArray())->onQueue('post_queue');

        Cache::forget('posts');

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        Redis::lpush('posts', $post->toJson());

        Cache::forget('posts');

        return redirect()->route('posts.index');
    }
}
