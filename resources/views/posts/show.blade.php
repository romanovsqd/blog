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
                <form action="{{ route('posts.comments.store', $post->id) }}" method="POST">
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

                    </li>
                @empty
                    <li>No comments yet</li>
                @endforelse
            </ul>
        </div>

    </div>
@endsection
