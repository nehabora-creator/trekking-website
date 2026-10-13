<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function show(Post $post)
    {
        abort_unless($post->is_published, 404);

        return view('posts.show', [
            'post' => $post,
            'others' => Post::where('is_published', true)->where('id', '!=', $post->id)->latest()->take(5)->get(),
        ]);
    }
}
