@extends('layouts.app')

@section('title')
    {{ $category->title }}
@endsection

@section('content')
    <div class="container mx-auto px-4">
        <div class="py-7">

            <x-heading class="text-center mb-10">
                {{ $category->name }}
            </x-heading>

            <x-search.form :action="route('categories.show', $category)" class="mb-10 flex justify-center items-center">

                <x-search.input :placeholder="__('Search posts')" />
                <x-search.sort-select />

            </x-search.form>

            <x-collection-list :collection="$posts" collectionName="posts">
                @foreach ($posts as $post)
                    <li>
                        <x-posts.card :post="$post">
                            <x-button :route="route('posts.show', $post->slug)">Read post</x-button>
                        </x-posts.card>
                    </li>
                @endforeach
            </x-collection-list>
        </div>
    </div>
@endsection
