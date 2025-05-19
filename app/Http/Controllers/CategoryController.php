<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        $categories = Category::query()
            ->when(
                $request->search,
                function (Builder $query, string $search) {
                    $query->where('name', 'like', "%{$search}%");
                }
            )
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
