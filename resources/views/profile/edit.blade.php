@extends('layouts.app')

@section('title')
    {{ __('profile settings') }}
@endsection

@section('content')
    <div class="container mx-auto px-4">
        <div class="py-7">

            <x-flash-message />

            <x-heading class="text-center mb-10">{{ __('Edit your profile') }}</x-heading>

            <div class="w-full md:max-w-lg mx-auto">

                <div class="mb-10">
                    <h4 class="text-xl font-medium mb-2">{{ __('Update profile') }}</h4>

                    <form action="{{ route('user-profile-information.update') }}" method="POST" class="w-full">
                        @csrf
                        @method('PUT')

                        <div class="mb-2">
                            <label for="email" class="block mb-1">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email" placeholder="email" value="{{ auth()->user()->email }}" class="input w-full text-lg">
                            @error('email', 'updateProfileInformation')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="name" class="block mb-1">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" placeholder="name" value="{{ auth()->user()->name }}" class="input w-full text-lg">
                            @error('name', 'updateProfileInformation')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn font-bold w-full">{{ __('Update profile') }}</button>
                    </form>

                </div>

                <div>

                    <h4 class="text-xl font-medium mb-2">{{ __('Change password') }}</h4>

                    <form action="{{ route('user-password.update') }}" method="POST" class="w-full">
                        @csrf
                        @method('PUT')

                        <div class="mb-2">

                            <div class="mb-2">
                                <label for="current_password" class="block mb-1">{{ __('Current password') }}</label>
                                <input type="password" name="current_password" id="current_password" placeholder="Current password" class="input w-full text-lg">
                                @error('current_password', 'updatePassword')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-2">
                                <label for="password" class="block mb-1">{{ __('New password') }}</label>
                                <input type="password" name="password" id="password" placeholder="new password" class="input w-full text-lg">
                                @error('password', 'updatePassword')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block mb-1">{{ __('Confirm password') }}</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="confirm password" class="input w-full text-lg">
                            </div>

                        </div>

                        <button type="submit" class="btn font-bold w-full">{{ __('Change password') }}</button>

                    </form>
                </div>

            </div>

        </div>
    </div>
@endsection
