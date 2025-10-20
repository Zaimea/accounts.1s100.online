<div class="hidden sm:flex">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                @foreach(config('accounts.available_locales') as $available_locale => $locale_name)
                    @if($available_locale === Auth::user()->language)
                        <img class="size-8 rounded-full object-cover"
                            src="https://cdn.custura.de/flags/l/{{ strtoupper($available_locale) }}.svg"
                        />
                    @elseif(!Auth::user()->language && config('app.locale') === $available_locale)
                        <img class="size-8 rounded-full object-cover"
                            src="https://cdn.custura.de/flags/l/{{ strtoupper($available_locale) }}.svg"
                        />
                    @endif
                @endforeach
            </button>
        </x-slot>

        <x-slot name="content">
            <div x-cloak class="block px-4 py-2 text-xs text-gray-400">
                @foreach(config('accounts.available_locales') as $available_locale => $locale_name)
                    <x-dropdown-link href="{{ route('lang.switcher', $available_locale) }}">
                        <div class="flex space-x-2">
                            <img class="size-4 rounded-full object-cover"
                                src="https://cdn.custura.de/flags/l/{{ strtoupper($available_locale) }}.svg"
                            />
                            <span>{{ __('@i18n-groups::lang.' . $locale_name) }}</span>
                        </div>
                    </x-dropdown-link>
                @endforeach
            </div>
        </x-slot>
    </x-dropdown>
</div>

<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <div class="flex justify-center space-x-3 px-4 py-2 text-xs text-indigo-500">
        @foreach(config('accounts.available_locales') as $available_locale => $locale_name)
            @if($available_locale !== Auth::user()->language)
                <a class="text-left leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800"
                    href="{{ route('lang.switcher', $available_locale) }}">
            @endif
                <div class="flex space-x-1">
                    <img class="size-4 rounded-full object-cover"
                        src="https://cdn.custura.de/flags/l/{{ strtoupper($available_locale) }}.svg"
                    />
                    <span>{{ __('@i18n-groups::lang.' . $locale_name) }}</span>
                </div>
            </a>
        @endforeach
    </div>
</div>
