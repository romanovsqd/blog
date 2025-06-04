@props(['post' => null])

<div {{ $attributes->merge(['class' => 'shadow-lg h-full rounded-md flex flex-col']) }}>

    {{-- post image --}}
    <div class="h-64 overflow-hidden rounded-lg">
        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="h-full w-full object-cover object-center lg:hover:scale-125 lg:transition-transform lg:duration-400">
    </div>

    {{-- post body --}}
    <div class="px-10 py-5 flex flex-col justify-between flex-grow">

        {{-- post header --}}
        <div class="flex justify-between flex-wrap gap-y-1 items-center font-medium mb-2 max-w-full">
            <span class="label">
                <p>{{ $post->created_at->diffForHumans() }}</p>
            </span>

            <strong class="break-words">
                <a href="{{ route('categories.show', $post->category) }}" class="link-hover whitespace-normal label cursor-pointer">
                    Category: {{ $post->category->name }}
                </a>
            </strong>
        </div>

        {{-- post content --}}
        <div class="mb-2">
            <h3 class="text-2xl mb-2"><a href="{{ route('posts.show', $post) }}" class="link-hover ">{{ Str::limit($post->title, 70) }}</a></h3>
            <div class="text-base">
                <p class="text-gray-500">{{ Str::limit($post->content, 170, '...') }}</p>
            </div>
        </div>

        {{ $slot }}

    </div>

</div>
