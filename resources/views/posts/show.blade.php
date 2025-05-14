@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="mb-4">

        <div>
            <p>{{ $post->title }}</p>
        </div>

        <div>
            <p>{{ $post->content }}</p>
        </div>

    </div>

    <div>

        <div class="mb-3">

            @guest
                <strong>Log in to leave a comment</strong>
            @endguest

            @auth
                <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                    @csrf

                    <div>
                        <textarea name="body" placeholder="say something..." class="border"></textarea>
                    </div>

                    <button type="submit" class="p-2 border">submit</button>
                </form>
            @endauth

        </div>
        <div>
            <ul>
                @forelse ($post->comments as $comment)
                    <li class="mb-3">

                        <div>
                            <p>{{ $comment->user->name }}</p>
                        </div>

                        <div>
                            <p>{{ $comment->body }}</p>
                        </div>

                        @auth

                            @if (auth()->id() === $comment->user_id || auth()->user()->isAdmin())
                                <div>
                                    <form action="{{ route('posts.comments.delete', ['post' => $post, 'comment' => $comment]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="border text-red-700">delete</button>
                                    </form>
                                </div>
                            @endif

                        @endauth

                    </li>
                @empty
                    <li>No comments yet</li>
                @endforelse
            </ul>
        </div>

    </div>
@endsection
