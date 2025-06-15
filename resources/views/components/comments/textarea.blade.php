@props(['route' => '#'])

<div {{ $attributes->merge(['class']) }}>
    @guest
        <strong>{{ __('Log in to leave a comment') }}</strong>
    @endguest

    @auth
        <form action="{{ $route }}" method="POST" class="text-center">
            @csrf

            <div class="mb-3">
                <textarea name="body" placeholder="Leave a comment" class="textarea w-full lg:w-5/6 text-lg min-h-36"></textarea>
            </div>

            <div>
                <button type="submit" class="btn btn-neutral btn-lg uppercase">{{ __('Submit') }}</button>
            </div>

        </form>
    @endauth
</div>
