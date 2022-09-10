<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

    @if (Route::has('login'))
            <x-guest-nav />
    @endif

    <div class="w-96">
        {{ $slot }}
    </div>

</div>