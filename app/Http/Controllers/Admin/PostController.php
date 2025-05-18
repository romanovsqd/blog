<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Builder;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
        ]);

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
            ->paginate(10)
            ->withQueryString();

        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        $categories = Category::query()->get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:10000'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $data['image'] = $path;
        }
        $data['user_id'] = auth()->user()->id;
        Post::query()->create($data);

        return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post): View
    {
        $categories = Category::query()->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:10000'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $post->update($data);

        return redirect()->route('admin.posts.index');
    }

    public function delete(Post $post): RedirectResponse
    {
        $post->delete();
        // ToDo: flash messages
        return redirect()->back();
    }
}
