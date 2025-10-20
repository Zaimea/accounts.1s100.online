<div class="flex items-center px-4">
    @if (\Zaimea\Accounts\Features::managesProfilePhotos())
        <div class="shrink-0 mr-3">
            <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
        </div>
    @endif

    <div>
        <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
    </div>
</div>

<div class="mt-3 space-y-1">
     {{-- Account Management --}}
    <x-responsive-nav-link href="{{ route('user.settings')}}" :active="request()->routeIs('user.settings')">
        {{ __('@i18n-groups::user-dropdown.profile_settings') }}
    </x-responsive-nav-link>

    @if (\Zaimea\Accounts\Features::hasApiFeatures())
        <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
            {{ __('@i18n-groups::user-dropdown.api_tokens') }}
        </x-responsive-nav-link>
        <x-responsive-nav-link href="{{ route('oauth-apps.index') }}" :active="request()->routeIs('oauth-apps.index')">
            {{ __('OAuth Apps') }}
        </x-responsive-nav-link>
    @endif

     {{-- Authentication --}}
    <form method="POST" action="{{ route('logout') }}" x-data>
        @csrf

        <x-responsive-nav-link href="{{ route('logout') }}"
                       @click.prevent="$root.submit();">
            {{ __('@i18n-groups::user-dropdown.log_out') }}
        </x-responsive-nav-link>
    </form>
</div>
