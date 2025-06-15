@extends('layouts.app')

@section('title')
    {{ __('categories') }}
@endsection

@section('content')
    <div class="container mx-auto px-4">
        <div class="py-7">

            <x-heading class="text-center mb-10">
                {{ __('All categories') }}
            </x-heading>

            <x-search.form :action="route('categories.index')" class="mb-10 flex justify-center items-center">
                <x-search.input :placeholder="__('Search categories')" />
            </x-search.form>

            <x-collection-list :collection="$categories" collectionName="categories" class="md:grid-cols-2 xl:grid-cols-3">

                @foreach ($categories as $category)
                    <li>
                        <div class="shadow-lg h-full rounded-md py-5 px-10 flex justify-between flex-col">

                            <div class="mb-4">
                                <h3 class="text-2xl mb-2">{{ $category->name }}</h3>
                                <p class="text-base label">{{ __('Posts:') }} {{ $category->posts_count }}</p>
                            </div>

                            <div class="text-center">
                                <x-button :route="route('categories.show', $category)">{{ __('View posts') }}</x-button>
                            </div>

                        </div>
                    </li>
                @endforeach
            </x-collection-list>

        </div>
    </div>
@endsection
