@extends('layouts.app')

@section('title')
    categories
@endsection

@section('content')
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
