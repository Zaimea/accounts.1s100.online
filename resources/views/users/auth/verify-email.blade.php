<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('@i18n-accounts::auth.before_continuing') }}
        </div>

        @session('status' == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ __('@i18n-accounts::auth.new_link_has_been_send') }}
            </div>
        @endsession

        <div class="mt-4 flex items-center text-sm justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button type="submit">
                        {{ __('@i18n-accounts::auth.resend_verification_email') }}
                    </x-button>
                </div>
            </form>

            <div>
                <a
                    href="{{ route('user.settings') }}"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                >
                    {{ __('@i18n-accounts::auth.edit_profile') }}</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 ml-2">
                        {{ __('@i18n-accounts::auth.log_out') }}
                    </button>
                </form>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
