<select name="sort" class="select join-item text-base w-full lg:w-max">
    <option value="newest" @selected(request('sort') === 'newest')>{{ __('Newest first') }}</option>
    <option value="oldest" @selected(request('sort') === 'oldest')>{{ __('Oldest first') }}</option>
</select>
