@extends('layouts.app')

@section('title')
    posts
@endsection

@section('content')
{{-- //TODO: split view to components --}}
    <div class="container mx-auto px-4">

        <div class="py-7">
            <div class="text-center mb-10">
                <h1 class="text-2xl font-bold">All Posts</h1>
            </div>

            <x-posts.search :action="route('posts.index')" :categories="$categories" class="mb-10 flex justify-center items-center" />

            @if ($posts->isempty())
                <p class="text-3xl font-bold text-center">No posts found</p>
            @else
                <div class="mb-7">
                    <ul class="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:gap-x-10 lg:gap-y-20">
                        @foreach ($posts as $post)
                            <li>
                                <div class="shadow-lg h-full rounded-md flex flex-col">

                                    <div class="h-64 overflow-hidden rounded-lg">
                                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="h-full w-full object-cover object-center lg:hover:scale-125 lg:transition-transform lg:duration-400">
                                    </div>

                                    <div class="px-10 py-5 flex flex-col justify-between flex-grow">

                                        <div class="flex justify-between flex-wrap gap-y-1 items-center font-medium mb-2">
                                            <span class="label pr-1">
                                                <p>{{ $post->created_at->diffForHumans() }}</p>
                                            </span>
                                            <a href="{{ route('categories.show', $post->category->slug) }}" class="link-hover label cursor-pointer">Category: {{ $post->category->name }}</a></strong>
                                        </div>

                                        <div class="mb-2">
                                            <h3 class="text-2xl mb-2"><a href="{{ route('posts.show', $post->slug) }}" class="link-hover ">{{ Str::limit($post->title, 70) }}</a></h3>
                                            <div class="text-base">
                                                <p class="text-gray-500">{{ Str::limit($post->content, 170, '...') }}</p>
                                            </div>
                                        </div>

                                        <div class="self-center lg:self-end">
                                            <a href="{{ route('posts.show', $post->slug) }}" class="uppercase font-semibold btn btn-lg lg:btn-md btn-neutral">Read post</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                {{ $posts->links() }}
            </div>

        </div>

    </div>
@endsection
