    <div>
        <form action="{{ $action }}" method="POST">
            @csrf
            @if ($method === 'PUT')
                @method('PUT')
            @endif

            <div>
                <input type="text" name="title" placeholder="title" class="border" value="{{ old('title', $post->title ?? '') }}">
            </div>

            <div>
                <textarea name="content" placeholder="content" class="border">{{ old('content', $post->content ?? '') }}</textarea>
            </div>

            <div class="mb-2">
                <select name="category_id" class="border p-2">
                    <option>select category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id ?? '') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="p-2 border">{{ $buttonText }}</button>

        </form>
    </div>
