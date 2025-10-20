<script>
    setDarkClass = () => {
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    }

    setDarkClass()

    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', setDarkClass)
</script>

<div
    class="relative"
        x-data="{
            menu: false,
            theme: localStorage.theme,
            darkMode() {
                this.theme = 'dark'
                localStorage.theme = 'dark'
                setDarkClass()
            },
            lightMode() {
                this.theme = 'light'
                localStorage.theme = 'light'
                setDarkClass()
            },
            systemMode() {
                this.theme = undefined
                localStorage.removeItem('theme')
                setDarkClass()
            },
        }"
        @click.outside="menu = false"
>
    <div class="hidden sm:flex">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button
                    x-cloak
                    class="block p-1 rounded hover:bg-gray-100 dark:hover:bg-gray-800"
                    :class="theme ? 'text-gray-700 dark:text-gray-300' : 'text-gray-400 dark:text-gray-600 hover:text-gray-500 focus:text-gray-500 dark:hover:text-gray-500 dark:focus:text-gray-500'"
                    @click="menu = ! menu"
                >
                    <x-heroicons::outline.sun class="block dark:hidden size-5" />
                    <x-heroicons::outline.moon class="hidden dark:block size-5" />
                </button>
            </x-slot>

            <x-slot name="content">
                <div x-cloak class="block px-4 py-2 text-xs text-gray-400">
                    <button class="flex items-center px-4 py-2 gap-3 hover:bg-gray-100 dark:hover:bg-gray-700" :class="theme === 'light' ? 'text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400'" @click="lightMode()">
                        <x-heroicons::outline.sun class="size-5" />
                        {{ __('@i18n-groups::darkmode.light') }}
                    </button>
                    <button class="flex items-center px-4 py-2 gap-3 hover:bg-gray-100 dark:hover:bg-gray-700" :class="theme === 'dark' ? 'text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400'" @click="darkMode()">
                        <x-heroicons::outline.moon class="size-5" />
                        {{ __('@i18n-groups::darkmode.dark') }}
                    </button>
                    <button class="flex items-center px-4 py-2 gap-3 hover:bg-gray-100 dark:hover:bg-gray-700" :class="theme === undefined ? 'text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400'" @click="systemMode()">
                        <x-heroicons::outline.computer-desktop class="size-5" />
                        {{ __('@i18n-groups::darkmode.system') }}
                    </button>
                </div>
            </x-slot>
        </x-dropdown>
    </div>
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div x-cloak class="flex justify-center space-x-3 px-4 py-2 text-xs text-indigo-500">
            <button class="flex items-center px-4 py-2 gap-3 hover:bg-gray-100 dark:hover:bg-gray-700" :class="theme === 'light' ? 'text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400'" @click="lightMode()">
                <x-heroicons::outline.sun class="size-5" />
                {{ __('@i18n-groups::darkmode.light') }}
            </button>
            <button class="flex items-center px-4 py-2 gap-3 hover:bg-gray-100 dark:hover:bg-gray-700" :class="theme === 'dark' ? 'text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400'" @click="darkMode()">
                <x-heroicons::outline.moon class="size-5" />
                {{ __('@i18n-groups::darkmode.dark') }}
            </button>
            <button class="flex items-center px-4 py-2 gap-3 hover:bg-gray-100 dark:hover:bg-gray-700" :class="theme === undefined ? 'text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400'" @click="systemMode()">
                <x-heroicons::outline.computer-desktop class="size-5" />
                {{ __('@i18n-groups::darkmode.system') }}
            </button>
        </div>
    </div>
</div>
