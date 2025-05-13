<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Category::query()->create($data);

        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category->update($data);

        return redirect()->route('admin.categories.index');
    }

    public function delete(Category $category): RedirectResponse
    {
        $category->delete();
        // ToDo: flash messages
        return redirect()->back();
    }
}
