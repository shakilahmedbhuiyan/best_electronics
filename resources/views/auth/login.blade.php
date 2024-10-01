@php
   \Artesaos\SEOTools\Facades\SEOTools::setTitle('Login');
    \Artesaos\SEOTools\Facades\SEOTools::setDescription('Login to your account');
    \Artesaos\SEOTools\Facades\SEOTools::opengraph()->setUrl(url()->current());
@endphp

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-application-mark class="h-16 w-16"/>
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-input id="email" right-icon="at-symbol" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autofocus autocomplete="username" label="Email" />
            </div>

            <div class="mt-4">
                <x-password label="Password" id="password" class="block mt-1 w-full" type="password"
                    name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}" wire:navigate>
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button-1 class="ms-4 bg" type="submit">
                    {{ __('Log in') }}
                </x-button-1>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
