@props([
    'action' => '#',
    'method' => null,
    'buttonText' => 'Save',
    'category' => null,
])

<div {{ $attributes->merge(['class' => '']) }}>
    <form action="{{ $action }}" method="POST" class="w-full md:w-lg mx-auto">
        @csrf

        @if ($method === 'PUT')
            @method('PUT')
        @endif

        <div class="mb-5">

            <input type="text" name="name" placeholder="Category name" value="{{ old('name', $category->name ?? '') }}" class="input w-full text-lg">
            @error('name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

        </div>

        <div class="flex flex-col gap-y-4 md:flex-row md:justify-between">
            <a href="{{ route('admin.categories.index') }}" class="btn font-bold w-full md:w-1/3">{{ __('Back to categories') }}</a>
            <button type="submit" class="btn font-bold w-full md:w-1/3 btn-neutral">{{ $buttonText }}</button>
        </div>

    </form>
</div>
