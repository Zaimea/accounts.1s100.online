<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 sticky top-0 z-50">
     {{-- Primary Navigation Menu --}}
    <div class="md:px-4">
        <div class="flex justify-between h-16">
            <div class="flex">
                 {{-- Logo --}}
                <div class="md:w-40 shrink-0 flex items-center group">
                    <a href="{{ route('home') }}">
                        <x-application-mark class="w-10" />
                    </a>
                    <a href="{{ route('home') }}">
                        <strong class="hidden ml-1 md:flex text-gray-500 dark:text-gray-400">{{ config('accounts.logo_name', 'Accounts') }}</strong>
                    </a>
                </div>

                 {{-- Navigation Links --}}
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                        Home
                    </x-nav-link>
                </div>

            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6 justify-end">
                 {{-- User Notofications --}}
                <div class="ml-3 relative">
                    @livewire('user-notifications')
                </div>
                 {{-- Language Switcher --}}
                <div class="ml-3 relative">
                    <x-switchable-lang/>
                </div>
                 {{-- User Dropdown --}}
                <div class="ml-3 relative">
                    <x-user-dropdown/>
                </div>
            </div>

             {{-- Hamburger --}}
            <div class="sm:-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

     {{-- Responsive Navigation Menu --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
         {{-- Responsive Settings Options --}}
        <div class="pt-1 pb-1 border-t border-gray-200 dark:border-gray-600">

             {{-- Lang Dropdown --}}
            <div class="mt-1 pt-2 space-y-1 border-t border-gray-200 dark:border-gray-600">
                <x-switchable-lang/>
            </div>

             {{-- Responsive User Dropdown --}}
            <div class="mt-1 pt-2 border-t border-gray-200 dark:border-gray-600">
                <x-user-dropdown-responsive/>
            </div>
        </div>
    </div>
</nav>
