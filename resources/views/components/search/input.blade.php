@props(['placeholder' => 'Search'])

<input type="text" name="search" placeholder="{{ $placeholder }}" value="{{ request('search') }}" class="input join-item w-full lg:w-96 text-lg">
