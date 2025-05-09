@extends('layouts.app')

@section('title')
    login
@endsection

@section('content')
    <div>
        <form action="{{ route('login') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div>
                    <ul class="text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div>
                <input type="email" name="email" placeholder="example@mail.com" class="border">
            </div>

            <div>
                <input type="password" name="password" placeholder="password" class="border">
            </div>

            <button type="submit" class="p-2 border">Login</button>

        </form>
    </div>
@endsection
