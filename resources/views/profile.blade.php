<!-- profile.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center items-center h-screen">
        <div class="max-w-xl w-full bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="mb-4 text-center flex justify-center items-center">
                <span class="font-bold">Your link:</span>
                <a href="{{ Request::url() }}" class="text-blue-500 hover:underline">{{ Request::url() }}</a>
                <form method="POST" class="ml-4" action="{{ route('renew') }}">
                    @csrf

                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        &#x21bb;
                    </button>
                </form>

                <form method="POST" class="ml-4" action="{{ route('invalidate') }}">
                    @csrf

                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        &#128683;
                    </button>
                </form>
            </div>

            <div class="mb-4 text-center">
                <span class="font-bold">Expires on:</span>
                <span>{{ $user->token_expires_at }}</span>
            </div>

            <div class="flex justify-center">
                <button id="feelingLuckyButton" onclick="openPopup()"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline w-40">
                    I'm feeling lucky
                </button>
                <button id="historyButton" onclick="getGameHistory()"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 focus:outline-none focus:shadow-outline w-40 ml-4">
                    History
                </button>
            </div>
        </div>
    </div>

    <div id="popup" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="relative bg-white rounded-lg p-8 ">
                <div class="text-center ">
                    <div id="apiResponse"></div>
                    <button onclick="closePopup()"
                            class="mt-4 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const userId = '{{ $user->id }}';
    </script>

</x-app-layout>
