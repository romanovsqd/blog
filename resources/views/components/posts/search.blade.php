<div>
    <form action="{{ $action }}" method="GET">

        <div class="mb-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="search posts" class="border px-2 py-1">
        </div>

        <button type="submit" class="border px-2 py-1">search</button>

    </form>
</div>
