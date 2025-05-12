<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('admin.posts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:10000'],
        ]);
        $data['user_id'] = auth()->user()->id;

        Post::query()->create($data);

        return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post): View
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:10000'],
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
