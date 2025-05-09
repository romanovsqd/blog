@extends('layouts.app')

@section('title')
    create post
@endsection

@section('content')
    <x-posts.form action="{{ route('admin.posts.store') }}" method="POST" buttonText="create"/>
@endsection
