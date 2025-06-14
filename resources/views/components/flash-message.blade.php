@if (session('success'))
    <div class="alert alert-success mb-2">
        <span>{{ session('success') }}</span>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-error mb-2">
        <span>{{ session('error') }}</span>
    </div>
@endif
