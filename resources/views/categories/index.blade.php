@extends('layouts.app')

@section('title')
    categories
@endsection

@section('content')
    <div class="mb-2">
        <form action="{{ route('categories.index') }}" method="GET">

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

            </li>
        @endforeach
    </ul>

    <div>
        {{ $categories->links() }}
    </div>
@endsection
