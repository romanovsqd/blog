@extends('layouts.app')

@section('title')
    {{ __('create post') }}
@endsection

@section('content')
    <div class="container mx-auto px-4">
        <div class="py-7">  
            
            <x-heading class="text-center mb-5">
                {{ __('Create new post') }}
            </x-heading>

            <x-posts.form action="{{ route('admin.posts.store') }}" method="POST" :categories="$categories" buttonText="{{ __('Create') }}" />
        </div>
    </div>
@endsection
