<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('groupInvitation') @session('clientInvitation')
            <x-slot name="header">
                <h4>
                    {{ __('@i18n-accounts::auth.log_in_or') }}<a class="underline hover:text-gray-900" href="{{ route('register') }}">{{ __('@i18n-accounts::auth.register') }}</a>
                    {{ __('@i18n-accounts::auth.to_join') }} <strong class="text-blue-800">{{ $value }}</strong>.
                </h4>
            </x-slot>
        @endsession @endsession

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('@i18n-accounts::auth.email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('@i18n-accounts::auth.password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            @if (\Zaimea\Accounts\Features::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4 flex items-center text-sm justify-between">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('@i18n-accounts::auth.i_agree_to', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="mt-4 flex items-center text-sm justify-between">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('@i18n-accounts::auth.remember_me') }}</span>
                </label>
                <x-button class="ml-4">
                    {{ __('@i18n-accounts::auth.log_in') }}
                </x-button>
            </div>

            <div class="flex items-center justify-center mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('@i18n-accounts::auth.forgot_your_password?') }}
                    </a>
                @endif
            </div>

            <div class="block mt-4 text-center">
                <span class="ml-2 text-sm text-gray-600">{{ __('@i18n-accounts::auth.new_around_here?') }}</span>
                <a class="underline hover:text-gray-900" href="{{ route('register') }}">{{ __('@i18n-accounts::auth.sign_up') }}</a>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
