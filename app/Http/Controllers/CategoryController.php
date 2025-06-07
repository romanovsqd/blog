<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        $categories = Category::query()
            ->search($request->search)
            ->withCount('posts')
            ->paginate(9)
            ->withQueryString();

        return view('categories.index', compact('categories'));
    }

    public function show(Request $request, Category $category): View
    {
        $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'sort' => ['nullable', 'string'],
        ]);

        $posts = $category->posts()
            ->search($request->search)
            ->sortByDate($request->sort)
            ->with('category')
            ->paginate(10);

        return view('categories.show', compact('category', 'posts'));
    }
}
