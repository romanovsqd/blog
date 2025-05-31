<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\View\View;
use App\Http\Requests\Post\IndexPostRequest;

class PostController extends Controller
{
    public function index(IndexPostRequest $request): View
    {
        $categories = Category::query()->get();

        $posts = Post::query()
            ->with('category')
            ->search($request->search)
            ->category($request->category)
            ->sortByDate($request->sort)
            ->paginate(10)
            ->withQueryString();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function show(Post $post): View
    {
        $comments = $post->comments()
        ->with('user')
        ->oldest()
        ->paginate(10)
        ->withQueryString();

        return view('posts.show', compact('post', 'comments'));
    }
}
