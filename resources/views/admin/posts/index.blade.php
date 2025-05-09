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

                <div>
                    <form action="{{ route('admin.posts.delete', $post->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border text-red-700">delete</button>
                    </form>
                </div>

            </li>
        @endforeach
    </ul>
@endsection
