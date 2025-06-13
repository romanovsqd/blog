@extends('layouts.app')

@section('title')
    create category
@endsection

@section('content')
    <div class="container mx-auto px-4">
        <div class="py-7">
            <x-heading class="text-center mb-10">Create category</x-heading>
            <x-categories.form action="{{ route('admin.categories.store') }}" method="POST" buttonText="Create" />
        </div>
    </div>
@endsection
