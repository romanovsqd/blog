<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::query()->get();
        return view('admin.posts.index', compact('posts'));
    }
}
