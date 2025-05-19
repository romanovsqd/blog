@extends('layouts.app')

@section('title')
    categories
@endsection

@section('content')
<div class="mb-2">
        <form action="{{ route('admin.categories.index') }}" method="GET">

            <div class="mb-2">
                <input type="text" name="search" placeholder="search categories" class="border px-2 py-1">
            </div>

            <button type="submit" class="border px-2 py-1">search</button>

        </form>
    </div>

    <ul>
        @foreach ($categories as $category)
            <li class="mb-4">

                <div>
                    <p>{{ $category->name }}</p>
                </div>

                <div>
                    <form action="{{ route('admin.categories.delete', $category)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border text-red-700">delete</button>
                        <a href="{{ route('admin.categories.edit', $category) }}" class="border py-0.5 text-blue-700">edit</a>
                    </form>
                </div>

            </li>
        @endforeach
    </ul>
    <div>
        {{ $categories->links() }}
    </div>
@endsection
