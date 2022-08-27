<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="w-96">
            @if (session('status'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
                    class="p-2 mb-4 bg-green-300 rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            <form action="/" method="post" class="grid gap-4">
                @csrf

                <label class="block">
                    <span class="text-gray-800">Unix-aika</span>
                    <input class="mt-1 block w-full rounded-md border-gray-300" type="text" id="unix-time"
                        name="unix-time" value="{{ $_SERVER['REQUEST_TIME'] }}" disabled>
                </label>

                <label for="remote-ip">
                    <span class="text-gray-800">IP-osoite</span>
                    <input class="mt-1 block w-full rounded-md border-gray-300" type="text" id="remote-ip"
                        name="remote-ip" value="{{ $_SERVER['REMOTE_ADDR'] }}" disabled>
                </label>

                {{-- <label for="http-request">

                    <span class="text-gray-800">{{ $_SERVER["REQUEST_METHOD"] }}</span>
                    <input class="mt-1 block w-full rounded-md border-gray-300" type="text" id="http-request"
                        name="http-request" value="{{ $_SERVER["REQUEST_URI"] }}" disabled>
                </label> --}}

                <label for="user-agent">

                    <span class="text-gray-800">Käyttäjäagentti</span>
                    <input class="mt-1 block w-full rounded-md border-gray-300" type="text" id="user-agent"
                        name="user-agent" value="{{ $_SERVER['HTTP_USER_AGENT'] }}" disabled>
                </label>

                <button type="submit"
                    class="mt-1 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Leimaa</button>

            </form>
        </div>
    </div>
</body>

</html>
