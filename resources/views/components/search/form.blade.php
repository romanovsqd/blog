@props(['action' => null])

<div {{ $attributes }}>
    <form action="{{ $action }}" method="GET" class="w-full sm:w-max">
        <div class="join text-base flex-col sm:flex-row w-full gap-y-2 sm:gap-0">
            {{ $slot }}
            <button type="submit" class="btn join-item text-base w-full sm:w-24">{{ __('Search') }}</button>
        </div>
    </form>
</div>
