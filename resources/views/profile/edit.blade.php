@extends('layouts.app')

@section('title')
    profile settings
@endsection

@section('content')
    <div>
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <input type="text" name="name" placeholder="name" value="{{ auth()->user()->name }}" class="border">
            </div>

            <div>

                <div>
                    <input type="password" name="password" placeholder="new password" class="border">
                </div>

                <div>
                    <input type="password" name="password_confirmation" placeholder="confirm password" class="border">
                </div>

            </div>

            <button type="submit" class="border p-2">save</button>

        </form>
    </div>
@endsection
