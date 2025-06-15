@extends('layouts.app')

@section('title')
    login
@endsection

@section('content')
    <div class="container mx-auto px-4 h-full ">
        <div class="h-full flex justify-center items-center">

            <div class="sm:max-w-xl w-full py-5 md:py-10">

                <div class="rounded-xl p-3 sm:py-12 sm:px-20 shadow-lg/15">

                    <h1 class="font-bold text-2xl text-center mb-8 text-shadow-sm/15">{{ __('Reset password') }}</h1>

                    <form action="{{ route('password.update') }}" method="POST" class="sm:max-w-96 sm:mx-auto">
                        @csrf
                        <input type="hidden" name="token" value="{{ request()->route('token') }}">

                        <div class="mb-5">
                            <label for="email" class="block mb-1">{{ __('Your email') }}</label>
                            <input name="email" id="email" type="email" autofocus placeholder="Example@mail.com" value="{{ old('email') }}" class="input w-full text-base">
                            @error('email')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="password" class="block mb-1">{{ __('New password') }}</label>
                            <input name="password" id="password" type="password" placeholder="Enter new password" class="input w-full text-base">
                            @error('password')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="password_confirmation" class="block mb-1">{{ __('Confirm new password') }}</label>
                            <input name="password_confirmation" id="password_confirmation" type="password" placeholder="Confirm new password" class="input w-full text-base">
                            @error('password')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 cursor-pointer transition-colors font-bold text-lg text-center text-white py-2 px-4 border rounded-lg">{{ __('Confirm') }}</button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
@endsection
