@extends('layouts.app')

@section('title')
    {{ __('login') }}
@endsection

@section('content')
    <div class="container mx-auto px-4 h-full ">

        @if (session('status'))
            <div class="py-7">
                <x-heading class="text-center mb-5">{{ __('Reset password') }}</x-heading>
                <p class="text-2xl text-center">{{ __('Check your email for a reset-password link.') }}</p>
            </div>
        @else
            <div class="h-full flex justify-center items-center">

                <div class="sm:max-w-xl w-full py-5 md:py-10">

                    <div class="rounded-xl p-3 sm:py-12 sm:px-20 shadow-lg/15">

                        <h1 class="font-bold text-2xl text-center mb-8 text-shadow-sm/15">{{ __('Reset password') }}</h1>

                        <form action="{{ route('password.email') }}" method="POST" class="sm:max-w-96 sm:mx-auto">
                            @csrf

                            <div class="mb-5">
                                <label for="email" class="block mb-1">{{ __('Email') }}</label>
                                <input name="email" id="email" type="email" autofocus placeholder="Example@mail.com" class="input w-full text-base">
                                @error('email')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 cursor-pointer transition-colors font-bold text-lg text-center text-white py-2 px-4 border rounded-lg">{{ __('Submit') }}</button>
                            </div>

                            <div>
                                <p class="text-lg text-center text-gray-500">{{ __("Don't have an account?") }} <a href="{{ route('register') }}" class="text-blue-600 hover:underline hover:text-blue-800 transition-colors">{{ __('Sign up') }}</a></p>
                            </div>

                        </form>

                    </div>

                </div>

            </div>
        @endif

    </div>
@endsection
