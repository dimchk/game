<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf


        <div>
            <x-input-label for="username" :value="__('Username')"/>
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                          required autofocus autocomplete="username"/>
            <x-input-error :messages="$errors->get('username')" class="mt-2"/>
        </div>

        <div class="mt-4">
            <x-input-label for="phone" :value="__('Phone number')"/>
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required
                          autocomplete="phone"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>

    </form>
</x-guest-layout>
