@extends('layouts.app')

@section('title')
    posts
@endsection

@section('content')
    <x-posts.search :action="route('admin.posts.index')" :categories="$categories" />

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
                    <form action="{{ route('admin.posts.delete', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border text-red-700">delete</button>
                        <a href="{{ route('admin.posts.edit', $post) }}" class="border py-0.5 text-blue-700">edit</a>
                    </form>
                </div>

            </li>
        @endforeach
    </ul>

    <div>
        {{ $posts->links() }}
    </div>
@endsection
