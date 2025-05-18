<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string'],
        ]);

        $categories = Category::query()->get();

        $posts = Post::query()
            ->when(
                $request->search,
                function (Builder $query, string $search) {
                    $query->where(function (Builder $query) use ($search) {
                        $query->where('title', 'like', "%{$search}%")
                            ->orWhere('content', 'like', "%{$search}%");
                    });
                }
            )
            ->when(
                $request->category,
                function (Builder $query, string $category) {
                    $query->whereHas('category', function (Builder $query) use ($category) {
                        $query->where('slug', $category);
                    });
                }
            )
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
