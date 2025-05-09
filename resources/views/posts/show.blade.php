@extends('layouts.app')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <div>
        <p>{{ $post->title }}</p>
    </div>

    <div>
        <p>{{ $post->content }}</p>
    </div>
@endsection
