@extends('layouts.app')

@section('title')
    categories
@endsection

@section('content')
    <div class="container mx-auto px-4">
        <div class="py-7">

            <x-flash-message />

            <x-heading class="text-center mb-10">Manage categories</x-heading>

            <x-search.form :action="route('admin.categories.index')" class="mb-10 flex justify-center items-center">
                <x-search.input :placeholder="__('Search categories')" />
            </x-search.form>

            <div class="text-center mb-10">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-lg font-bold uppercase btn-neutral">
                    Create Category
                </a>
            </div>

            @if ($categories->isEmpty())
                <div>
                    <p class="text-3xl font-bold text-center">No categories found</p>
                </div>
            @else
                <div class="overflow-x-auto mb-5">

                    <table class="table text-base">

                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Posts count</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($categories as $category)
                                <tr>

                                    {{-- name --}}
                                    <td>
                                        <h4 class="font-bold">{{ $category->name }}</h4>
                                    </td>

                                    {{-- slug --}}
                                    <td class="max-w-3xs">
                                        <span class="font-bold">{{ $category->slug }}</span>
                                    </td>

                                    {{-- posts count --}}
                                    <td>
                                        <span class="font-medium">
                                            {{ $category->posts_count > 0 ? $category->posts_count : 'none' }}
                                        </span>
                                    </td>

                                    {{-- created at --}}
                                    <td>
                                        <div>
                                            {{ $category->created_at->format('d.m.Y H:i') }}
                                        </div>
                                    </td>

                                    {{-- updated at --}}
                                    <td>
                                        <div>
                                            {{ $category->updated_at->format('d.m.Y H:i') }}
                                        </div>
                                    </td>

                                    {{-- actions --}}
                                    <td>
                                        <form action="{{ route('admin.categories.delete', $category) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <div class="dropdown dropdown-hover dropdown-left dropdown-end">

                                                <div tabindex="0" role="button" class="btn btn-neutral m-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block h-5 w-5 stroke-current">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                                                    </svg>
                                                </div>

                                                <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box w-52 p-2 shadow-sm font-medium">

                                                    <li>
                                                        <a href="{{ route('categories.show', $category) }}" target="_blank">Show</a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('admin.categories.edit', $category) }}">Edit</a>
                                                    </li>

                                                    <li>
                                                        <button type="submit" class="text-red-700">Delete</button>
                                                    </li>

                                                </ul>

                                            </div>

                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Posts count</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>

                    </table>

                </div>

                <div>
                    {{ $categories->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection
