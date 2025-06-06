@props(['route' => '#'])

<div class="self-center lg:self-end">
    <a href="{{ $route }}" class="uppercase font-semibold btn btn-lg lg:btn-md btn-neutral">{{ $slot }}</a>
</div>
