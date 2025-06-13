@extends('layouts.app')

@section('title')
    posts
@endsection

@section('content')
    <div class="container mx-auto px-4">
        <div class="py-7">

            <x-heading class="text-center">Manage posts</x-heading>

            <x-search.form :action="route('admin.posts.index')" class="mb-10 flex justify-center items-center">

                <x-search.input :placeholder="__('Search posts')" />
                <x-search.category-select :categories="$categories" />
                <x-search.sort-select />

            </x-search.form>

            <div class="text-center mb-10">
                <a href="{{ route('admin.posts.create') }}" class="btn btn-lg font-bold uppercase btn-neutral">
                    Create Post
                </a>
            </div>

            @if ($posts->isEmpty())
                <div>
                    <p class="text-3xl font-bold text-center">No posts found</p>
                </div>
            @else
                <div class="overflow-x-auto">

                    <table class="table text-base">

                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($posts as $post)
                                <tr>

                                    {{-- image --}}
                                    <td>
                                        <div class="avatar">
                                            <div class="h-20 w-40 rounded-md">
                                                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" />
                                            </div>
                                        </div>
                                    </td>

                                    {{-- title --}}
                                    <td>
                                        <h4 class="font-bold">{{ $post->title }}</h4>
                                    </td>

                                    {{-- category --}}
                                    <td class="max-w-3xs">
                                        <a href="{{ route('categories.show', $post->category) }}" class="font-medium link link-hover">{{ $post->category->name }}</a>
                                    </td>

                                    {{-- author --}}
                                    <td>
                                        <span class="font-medium">
                                            {{ $post->user->name }}
                                        </span>
                                    </td>

                                    {{-- created at --}}
                                    <td>
                                        {{ $post->created_at->format('d.m.Y H:i') }}
                                    </td>
                                    {{-- updated at --}}
                                    <td>
                                        <div>
                                            {{ $post->updated_at->format('d.m.Y H:i') }}
                                        </div>
                                    </td>

                                    {{-- actions --}}
                                    <td>
                                        <form action="{{ route('admin.posts.delete', $post) }}" method="POST">
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
                                                        <a href="{{ route('posts.show', $post) }}" target="_blank">Show</a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('admin.posts.edit', $post) }}">Edit</a>
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

                        <!-- foot -->
                        <tfoot>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>

                    </table>

                </div>
            @endif

            <div>
                {{ $posts->links() }}
            </div>

        </div>
    </div>
@endsection
