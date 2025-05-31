@props(['categories' => null])

<select name="category" class="select join-item text-base w-full lg:w-max">

    <option value="">{{ __('All categories') }}</option>

    @foreach ($categories as $category)
        <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>
    @endforeach

</select>
