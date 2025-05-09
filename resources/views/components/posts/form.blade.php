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

          <button type="submit" class="p-2 border">{{ $buttonText }}</button>

      </form>
  </div>
