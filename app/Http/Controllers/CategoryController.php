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
            ->paginate(10)
            ->withQueryString();

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category): View
    {
        $category->load('posts');
        return view('categories.show', compact('category'));
    }
}
