<div>
    <form action="{{ $action }}" method="GET">

        <div class="mb-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="search posts" class="border px-2 py-1">
        </div>

        <div>
            <select name="category_id" class="border px-2 py-1 mb-2">

                <option value="">All categories</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
                @endforeach

            </select>
        </div>

        <button type="submit" class="border px-2 py-1">search</button>

    </form>
</div>
