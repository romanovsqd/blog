@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto px-4">
        <div class="py-10 max-w-5xl mx-auto text-lg">

            <div class="border-b-2 border-gray-200 mb-5 pb-5">

                <div class="h-96 overflow-hidden">
                    <img src="{{ $post->image_url }}" alt="{{ $post->title ?? 'post image' }}" class="w-full h-full object-cover object-center">
                </div>

                <div>

                    <div class="flex justify-between flex-wrap gap-y-1 items-center font-medium mb-2 px-5">
                        <span class="label pr-1">
                            <p>{{ $post->created_at->diffForHumans() }}</p>
                        </span>
                        <a href="{{ route('categories.show', $post->category->slug) }}" class="link-hover label cursor-pointer">Category: {{ $post->category->name }}</a></strong>
                    </div>

                    <div class="mb-5 px-4">
                        <h1 class="text-2xl">{{ $post->title }}</h1>
                    </div>

                    <div class="indent-4">
                        <p class="">{{ $post->content }}</p>
                    </div>

                </div>

            </div>

            <div class="mb-5">

                <div class="mb-5">
                    @if ($comments->isEmpty())
                        <strong>No comments yet</strong>
                    @else
                        <ul>
                            @foreach ($comments as $comment)
                                <li class="border-b-2 border-gray-200 p-5">

                                    <div class="flex gap-x-2 mb-2 items-center">
                                        <p>{{ $comment->user->name }}</p>
                                        <span class="label">{{ $comment->created_at->diffForHumans() }}</span>
                                        @auth

                                            @if (auth()->id() === $comment->user_id || auth()->user()->isAdmin())
                                                <div class="dropdown dropdown-left dropdown-hover">

                                                    <form action="{{ route('posts.comments.delete', ['post' => $post, 'comment' => $comment]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <div tabindex="0" role="button" class="btn btn-xs">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-3 w-5 stroke-current">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                                                            </svg>
                                                        </div>

                                                        <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
                                                            <li><button type="submit" class="text-red-700 font-bold cursor-pointer">delete</button></li>
                                                        </ul>

                                                    </form>

                                                </div>
                                            @endif

                                        @endauth
                                    </div>

                                    <div class="indent-8">
                                        <p>{{ $comment->body }}</p>
                                    </div>

                                </li>
                            @endforeach
                        </ul>
                    @endif

                </div>

                <div class="border-b-2 border-gray-200 pb-5">

                    @guest
                        <strong>Log in to leave a comment</strong>
                    @endguest

                    @auth
                        <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="text-center">
                            @csrf

                            <div class="mb-3">
                                <textarea name="body" placeholder="Leave a comment" class="textarea w-full lg:w-5/6 text-lg min-h-36"></textarea>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-neutral btn-lg uppercase">Submit</button>
                            </div>

                        </form>
                    @endauth

                </div>

            </div>

            <div>
                {{ $comments->links() }}
            </div>
        </div>

    </div>
@endsection
