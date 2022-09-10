<x-guest-layout>
    <x-guest-content>

            @if (session('status'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
                    class="p-2 mb-4 bg-green-300 dark:bg-green-900 dark:text-white rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            <div class="font-serif text-2xl font-medium mb-3 text-gray-700 dark:text-gray-500">
                @if (session('prev_verse'))
                    {{ ucfirst(session()->get('prev_verse')->verse_text) }}
                @else
                    {{ ucfirst($verse->verse_text) }}
                @endif
            </div>

            <div class="dark:text-gray-500">
                @if (session('prev_verse'))
                    {{ session()->get('prev_verse')->book_name }}
                    {{ session()->get('prev_verse')->chapter }}:{{ session()->get('prev_verse')->verse }}
                @else
                    {{ $verse->book_name }} {{ $verse->chapter }}:{{ $verse->verse }}
                @endif
            </div>

            @if (!session('prev_verse'))
                <form action="/verse" method="post" id="post-verse">
                    @csrf
                    <input type="hidden" name="verse" value="{{ ucfirst($verse->verse_text) }}">
                </form>
                <button form="post-verse" type="submit"
                    class="mt-3 px-4 py-3 bg-gray-800 dark:bg-purple-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 hover:dark:bg-purple-800  active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Tykkää
                </button>
            @endif

            <button x-data="{}" x-on:click="location.reload(); return false;"
                class="inline mt-3 px-4 py-3 bg-gray-800 dark:bg-purple-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 hover:dark:bg-purple-800  active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Uusi
                jae
            </button>

    </x-guest-content>
</x-guest-layout>
