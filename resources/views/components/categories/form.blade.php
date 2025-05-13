  <div>
      <form action="{{ $action }}" method="POST">
          @csrf
          @if ($method === 'PUT')
              @method('PUT')
          @endif

          <div>
              <input type="text" name="name" placeholder="category name" class="border" value="{{ old('name', $category->name ?? '') }}">
          </div>

          <button type="submit" class="p-2 border">{{ $buttonText }}</button>

      </form>
  </div>
