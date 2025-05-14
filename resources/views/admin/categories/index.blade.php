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
