@props(['action', 'categories' => null])

<div {{ $attributes }}>
    <form action="{{ $action }}" method="GET" class="w-full sm:w-max">
        <div class="join text-base flex-col sm:flex-row w-full gap-y-2 sm:gap-0">

            <input type="text" name="search" value="{{ request('search') }}" placeholder="search posts" class="input join-item w-full lg:w-96 text-lg">

            <select name="category" class="select join-item text-base w-full lg:w-max">

                <option value="">{{ __('All categories') }}</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>
                @endforeach

            </select>

            <select name="sort" class="select join-item text-base w-full lg:w-max">
                <option value="newest" @selected(request('sort') === 'newest')>{{ __('Newest first') }}</option>
                <option value="oldest" @selected(request('sort') === 'oldest')>{{ __('Oldest first') }}</option>
            </select>

            <button type="submit" class="btn join-item text-base w-full sm:w-24">{{ __('Search') }}</button>

        </div>
    </form>
</div>
