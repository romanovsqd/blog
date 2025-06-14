@extends('layouts.app')

@section('title')
    verify email
@endsection

@section('content')
    <div class="container mx-auto px-4">
        <div class="py-7">

            <x-flash-message />

            <x-heading class="text-center mb-5">{{ __('Verify your email') }}</x-heading>

            <form action="{{ route('verification.send') }}" method="POST">
                @csrf

                <div class="flex gap-x-1 text-2xl justify-center">
                    <p>{{ __('Check your email for a verification link.') }}</p>
                    <button type="submit" class="link">{{ __('Resend link.') }}</button>
                </div>
            </form>

        </div>
    </div>
@endsection
