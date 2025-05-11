<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()->get();
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post): View
    {
        $post->load('comments.user');
        return view('posts.show', compact('post'));
    }
}
