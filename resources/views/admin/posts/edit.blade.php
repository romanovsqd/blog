@extends('layouts.app')

@section('title')
    edit post
@endsection

@section('content')
    <div class="container mx-auto px-4">
        <div class="py-7">
            <x-heading class="text-center mb-5">Edit post</x-heading>
            <x-posts.form action="{{ route('admin.posts.update', $post) }}" method="PUT" buttonText="Save" :post="$post" :categories="$categories" />
        </div>
    </div>
@endsection
