@extends('layouts.app')

@section('title')
    edit post
@endsection

@section('content')
    <x-posts.form action="{{ route('admin.posts.update', $post->slug) }}" method="PUT" buttonText="save" :post="$post" :categories="$categories"/>
@endsection
