@extends('layouts.app')

@section('title')
    login
@endsection

@section('content')
    <div class="container mx-auto px-4 h-full flex justify-center items-center">
        <div class="sm:max-w-xl w-full py-5 md:py-10">

            <div class="rounded-xl p-3 sm:py-12 sm:px-20 shadow-lg/15">

                <h1 class="font-bold text-2xl text-center mb-8 text-shadow-sm/15">{{ __('Login to your account') }}</h1>

                <form action="{{ route('login') }}" method="POST" class="sm:max-w-96 sm:mx-auto">
                    @csrf

                    <div class="mb-5">
                        <label for="email" class="block mb-1">{{ __('Email') }}</label>
                        <input name="email" id="email" type="email" autofocus placeholder="Example@mail.com" value="{{ old('email') }}" class="input w-full text-base">
                        @error('email')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block">{{ __('Password') }}</label>
                            {{-- //TODO: password reset --}}
                            <a href="#" class="text-blue-600 hover:underline hover:text-blue-800 transition-colors">{{ __('Forgot?') }}</a>
                        </div>
                        <input name="password" id="password" type="password" placeholder="Enter your password" class="input w-full text-base">
                        @error('password')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="remember_me" class="flex items-center gap-1">
                            <input name="remember_me" id="remember_me" type="checkbox" class="checkbox">
                            {{ __('Remember me') }}
                        </label>
                    </div>

                    <div class="mb-5">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 cursor-pointer transition-colors font-bold text-lg text-center text-white py-2 px-4 border rounded-lg">{{ __('Login') }}</button>
                    </div>

                    <div>
                        <p class="text-lg text-center text-gray-500">{{ __("Don't have an account?") }} <a href="{{ route('register') }}" class="text-blue-600 hover:underline hover:text-blue-800 transition-colors">{{ __('Sign up') }}</a></p>
                    </div>

                </form>

            </div>

        </div>
    </div>
@endsection
