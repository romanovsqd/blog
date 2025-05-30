@extends('layouts.app')

@section('title')
    register
@endsection

@section('content')
    <div class="container mx-auto px-4 h-full flex justify-center items-center">
        <div class="sm:max-w-xl w-full py-5 md:py-10">

            <div class="rounded-xl p-3 sm:py-12 sm:px-20 shadow-lg/15">

                <h1 class="font-bold text-2xl text-center mb-8 text-shadow-sm/15">{{ __('Create an account') }}</h1>

                <form action="{{ route('register') }}" method="POST" class="sm:max-w-96 sm:mx-auto">
                    @csrf

                    <div class="mb-5">
                        <label for="email" class="block mb-1">{{ __('Email') }}<span class="text-red-500 ml-1">*</span></label>
                        <input name="email" id="email" type="mail" autofocus placeholder="Example@mail.com" value="{{ old('email') }}" class="input w-full text-base">
                        @error('email')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="name" class="block mb-1">{{ __('Name') }}<span class="text-red-500 ml-1">*</span></label>
                        <input name="name" id="name" type="text" autofocus placeholder="Username" value="{{ old('name') }}" class="input w-full text-base">
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block">{{ __('Password') }}<span class="text-red-500 ml-1">*</span></label>
                        </div>
                        <input name="password" id="password" type="password" placeholder="Enter your password" class="input w-full text-base">
                        @error('password')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <div class="flex items-center justify-between mb-1">
                            <label for="password_confirmation" class="block">{{ __('Confirm password') }}<span class="text-red-500 ml-1">*</span></label>
                        </div>
                        <input name="password_confirmation" id="password_confirmation" type="password" placeholder="Repeat password" class="input w-full text-base">
                    </div>

                    <div class="mb-5">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 cursor-pointer transition-colors font-bold text-lg text-center text-white py-2 px-4 border rounded-lg">{{ __('Create account') }}</button>
                    </div>

                    <div>
                        <p class="text-lg text-center text-gray-500">{{ __('Already have an account?') }} <a href="{{ route('login') }}" class="text-blue-600 hover:underline hover:text-blue-800 transition-colors">{{ __('Log In') }}</a></p>
                    </div>

                </form>

            </div>

        </div>
    </div>
@endsection
