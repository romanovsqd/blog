@extends('layouts.app')

@section('title')
    {{ __('Home') }}
@endsection

@section('content')
    <div class="container mx-auto px-4">
        <div class="py-7">
            <x-flash-message />

            <x-heading class="text-center mb-10">
                {{ __('Recent posts') }}
            </x-heading>

            @if ($posts->isEmpty())
                <div>
                    <p class="text-3xl font-bold text-center">{{ __('No posts found') }}</p>
                </div>
            @else
                <div class="mb-10">
                    <ul class="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:gap-x-10 lg:gap-y-20">
                        @foreach ($posts as $post)
                            <li>
                                <x-posts.card :post="$post">
                                    <x-button :route="route('posts.show', $post->slug)">{{ __('Read post') }}</x-button>
                                </x-posts.card>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="text-center">
                    <a class="btn btn-xl btn-neutral text-2xl" href="{{ route('posts.index') }}">Explore more ➔</a>
                </div>
            @endif

        </div>

    </div>
@endsection
