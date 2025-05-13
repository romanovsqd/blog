@extends('layouts.app')

@section('title')
    create category
@endsection

@section('content')
    <x-categories.form action="{{ route('admin.categories.store') }}" method="POST" buttonText="create"/>
@endsection
