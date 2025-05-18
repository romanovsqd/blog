@extends('layouts.app')

@section('title')
    posts
@endsection

@section('content')
    <x-posts.search :action="route('posts.index')" :categories="$categories" />

    <ul>
        @foreach ($posts as $post)
            <li class="mb-4">

                <div>
                    <p>{{ $post->created_at }}</p>
                </div>
                
                <div>
                    <p>{{ $post->title }}</p>
                </div>

                <div>
                    <p>{{ $post->content }}</p>
                </div>

            </li>
        @endforeach
    </ul>

    <div>
        {{ $posts->links() }}
    </div>
@endsection
