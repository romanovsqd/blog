@props([
    'collection' => null,
    'collectionName' => null,
])

@if (empty($collection))
    <div>
        <p class="text-3xl font-bold text-center">No {{ $collectionName }} found</p>
    </div>
@else
    <div class="mb-7">
        <ul {{ $attributes->merge(['class' => 'grid grid-cols-1 gap-10 lg:grid-cols-2 lg:gap-x-10 lg:gap-y-20']) }}>
            {{ $slot }}
        </ul>
    </div>

    <div>
        {{ $collection->links() }}
    </div>
@endif
