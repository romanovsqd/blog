@if (session('success'))
    <div class="alert alert-success mb-2">
        <span>{{ session('success') }}</span>
    </div>
@endif

@if (session('status') === 'verification-link-sent')
    <div role="alert" class="alert alert-info mb-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="h-6 w-6 shrink-0 stroke-current">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span>We've sent a verification link to your email.</span>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-error mb-2">
        <span>{{ session('error') }}</span>
    </div>
@endif
