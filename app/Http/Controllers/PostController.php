<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string'],
            'sort' => ['nullable', 'string'],
        ]);

        $categories = Category::query()->get();

        $posts = Post::query()
            ->search($request->search)
            ->category($request->category)
            ->sortByDate($request->sort)
            ->paginate(10)
            ->withQueryString();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function show(Post $post): View
    {
        $post->load('comments.user');
        return view('posts.show', compact('post'));
    }
}
