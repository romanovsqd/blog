@extends('layouts.app')

@section('title')
    posts
@endsection

@section('content')
    <ul>
        @foreach ($posts as $post)
            <li class="mb-4">

                <div>
                    <p>{{ $post->title }}</p>
                </div>

                <div>
                    <p>{{ $post->content }}</p>
                </div>

            </li>
        @endforeach
    </ul>
@endsection
