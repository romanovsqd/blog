<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Post\IndexPostRequest;
use App\Http\Requests\Admin\Post\PostRequest;

class PostController extends Controller
{
    public function index(IndexPostRequest $request): View
    {
        $categories = Category::query()->get();

        $posts = Post::query()
            ->search($request->search)
            ->category($request->category)
            ->sortByDate($request->sort)
            ->paginate(10)
            ->withQueryString();

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::query()->get();
        return view('admin.posts.create', compact('categories'));
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $data = $this->prepareData($request);

        Post::query()->create($data);
        return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post): View
    {
        $categories = Category::query()->get();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $data = $this->prepareData($request);

        $post->update($data);
        return redirect()->route('admin.posts.index');
    }

    public function delete(Post $post): RedirectResponse
    {
        $post->delete();
        // ToDo: flash messages
        return redirect()->back();
    }

    private function prepareData(PostRequest $request): array
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $data['user_id'] = auth()->user()->id;

        return $data;
    }
}
