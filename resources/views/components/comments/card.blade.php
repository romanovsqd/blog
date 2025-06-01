@props([
    'comment' => null,
    'post' => null,
])

<div class="border-b-2 border-gray-200 p-5">

    {{-- comment-header --}}
    <div class="flex gap-x-2 mb-2 items-center">
        <p>{{ $comment->user->name }}</p>
        <span class="label">{{ $comment->created_at->diffForHumans() }}</span>
        @auth

            {{-- comment-dropdown --}}
            @if (auth()->id() === $comment->user_id || auth()->user()->isAdmin())
                <div class="dropdown dropdown-left dropdown-hover">

                    <form action="{{ route('posts.comments.delete', ['post' => $post, 'comment' => $comment]) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        {{-- dropdown-button --}}
                        <div tabindex="0" role="button" class="btn btn-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-3 w-5 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                            </svg>
                        </div>

                        {{-- dropdown-actions --}}
                        <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
                            <li>
                                <button type="submit" class="text-red-700 font-bold cursor-pointer">delete</button>
                            </li>
                        </ul>

                    </form>

                </div>
            @endif

        @endauth
    </div>

    {{-- comment-body --}}
    <div class="indent-8">
        <p>{{ $comment->body }}</p>
    </div>

</div>
