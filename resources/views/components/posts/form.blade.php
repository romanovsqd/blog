@props([
    'action' => '#',
    'method' => null,
    'categories' => null,
    'buttonText' => 'Save',
    'post' => null,
])

<div {{ $attributes->merge(['class' => '']) }}>

    <form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="w-full lg:w-2/3 mx-auto">
        @csrf

        @if ($method === 'PUT')
            @method('PUT')
        @endif

        <div class="mb-3">

            <input type="text" name="title" placeholder="Post title" value="{{ old('title', $post->title ?? '') }}" class="input w-full text-lg">
            @error('title')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

        </div>

        <div class="mb-3">
            <textarea name="content" placeholder="Post content" class="textarea w-full text-lg min-h-50">{{ old('content', $post->content ?? '') }}</textarea>
            @error('content')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3 w-full md lg:w-2/3 mx-auto">
            <select name="category_id" class="select w-full">
                <option>select category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id ?? '') == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3 lg:w-2/3 mx-auto">
            <input type="file" name="image" class="file-input w-full">
            @error('image')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="lg:w-1/2 mx-auto">
            <button type="submit" class="btn font-bold w-full">{{ $buttonText }}</button>
        </div>

    </form>

</div>
