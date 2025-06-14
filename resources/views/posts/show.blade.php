@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div class="container mx-auto px-4">
        <div class="py-10 max-w-5xl mx-auto text-lg">

            <x-flash-message />

            <x-posts.card :post="$post" class="md:w-full mb-5" />

            <div class="mb-5">

                @if ($comments->isEmpty())
                    <strong>No comments yet</strong>
                @else
                    <ul>
                        @foreach ($comments as $comment)
                            <li>
                                <x-comments.card :comment="$comment" :post="$post" />
                            </li>
                        @endforeach
                    </ul>
                @endif

            </div>

            <x-comments.textarea :route="route('posts.comments.store', $post)" class="border-b-2 border-gray-200 pb-5 mb-5" />

            <div>
                {{ $comments->links() }}
            </div>

        </div>

    </div>
@endsection
