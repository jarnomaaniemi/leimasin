<x-guest-layout>
    <x-guest-content>

        <div class="font-serif text-3xl font-medium mb-3 text-gray-700 dark:text-gray-500">Stamp</div>

        @if (session('status'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
                class="p-2 mb-4 bg-green-300 dark:bg-green-900 dark:text-white rounded-md">
                {{ session('status') }}
            </div>
        @endif

        <form action="/stamp" method="post" class="grid gap-4">
            @csrf

            <label for="remote-ip">
                <span class="text-gray-700 dark:text-gray-500">Your IP-address</span>
                <input
                    class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-800 dark:border-gray-800 dark:text-white"
                    type="text" id="remote-ip" name="remote-ip" value="{{ $_SERVER['REMOTE_ADDR'] }}">
            </label>

            {{-- <label class="block">
                    <span class="text-gray-700 dark:text-gray-500">Unix-aika</span>
                    <input class="mt-1 block w-full rounded-md border-gray-300" type="text" id="unix-time"
                        name="unix-time" value="{{ $_SERVER['REQUEST_TIME'] }}">
                </label> --}}

            <label for="user-agent">
                <span class="text-gray-700 dark:text-gray-500">Your device</span>
                <input
                    class="mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-800 dark:border-gray-800 dark:text-white"
                    type="text" id="user-agent" name="user-agent"
                    value="{{ $agent->browser() }} {{ $agent->version($agent->browser()) }} {{ $agent->platform() }} {{ $agent->version($agent->platform()) }}">
            </label>

            <label for="message">
                <span class="text-gray-700 dark:text-gray-500">Message</span>
                <input
                    class="mt-1 block w-full rounded-md border-gray-300 placeholder:text-red-500 dark:bg-gray-800 dark:border-gray-800 dark:text-white"
                    type="text" id="message" name="message"
                    @error('message') placeholder="{{ $message }}" @enderror>
            </label>

            <button type="submit"
                class="mt-3 px-4 py-3 bg-gray-800 dark:bg-purple-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 hover:dark:bg-purple-800  active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Stamp</button>
        </form>

    </x-guest-content>
</x-guest-layout>
