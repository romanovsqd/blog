@extends('layouts.app')

@section('title')
    edit category
@endsection

@section('content')
    <div class="container mx-auto px-4">
        <div class="py-7">
            <x-heading class="text-center mb-10">Edit category</x-heading>
            <x-categories.form action="{{ route('admin.categories.update', $category) }}" method="PUT" buttonText="Save" :category="$category" />
        </div>
    </div>
@endsection
