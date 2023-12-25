<x-guest-layout>
<h1>ユーザー新規登録画面</h1>
   <form method="POST" action="{{ route('register') }}">
        @csrf


        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus  />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
            <div class="mt-4">
            <x-input-label for="email" :value="__('アドレス')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            @if($errors->has('password'))
        <p>{{ $errors->first('password') }}</p>
        @endif
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            @if($errors->has('email'))
        <p>{{ $errors->first('email') }}</p>
        @endif
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

            <x-primary-button class="ml-4" >
                {{ __('新規登録') }}
            </x-primary-button>


    <x-primary-button class="ml-4" onclick="location.href='http://localhost:8888/Ct_project/public/login'">
                {{ __('戻る') }}
            </x-primary-button>

    </div>
    </form>
</x-guest-layout>
