@extends('layouts.app')

@section('title')
    {{ $category->title }}
@endsection

@section('content')
    <div class="mb-4">

        <div>
            <ul>
                @foreach ($category->posts as $post)
                    <li class="mb-5">
                        <div>
                            <p>{{ $post->title }}</p>
                        </div>

                        <div>
                            <p>{{ $post->content }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>

@endsection
