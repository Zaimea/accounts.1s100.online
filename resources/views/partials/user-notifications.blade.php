<div>
    <x-nav-link wire:click="handleNotificationsToggle({{ true }})" wire:loading.attr="disabled">
        @if ($this->user->unreadNotifications->isNotEmpty())
            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none transition">
                <x-icon class="size-5 text-indigo-600" name="bell-alert" />
                <span class="text-gray-500 dark:text-white ml-1"><sup>{{ $this->user->unreadNotifications->count() }}</sup>
            </button>
        @else
            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none transition">
                <x-icon class="size-5 text-gray-400" name="bell" />
            </button>
        @endif
    </x-nav-link>

    @if(true == $notificationsManager)
        <div class="fixed inset-0 transition-opacity" wire:click="handleNotificationsToggle()">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="fixed w-96 top-0 right-0 z-50">
            <div class="bg-gray-50 dark:bg-gray-700 h-screen overflow-y-auto p-8">
                <div class="flex items-center justify-between">
                    <p tabindex="0" class="focus:outline-none text-2xl font-semibold leading-6 text-gray-800 dark:text-gray-200">
                        {{ __('@i18n-groups::notifications.notifications') }}
                    </p>
                    <button wire:click="handleNotificationsToggle()" role="button" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 rounded-md cursor-pointer">
                        <x-icon class="size-5" name="x-mark"/>
                    </button>
                </div>
                @if ($this->user->unreadNotifications()->count() > 0)
                    <div wire:click="markAllAsRead()" class="block cursor-pointer px-4 py-2 text-xs text-gray-400">
                        {{ __('@i18n-groups::notifications.mark_all_as_read') }}
                    </div>
                @endif
                @if ($this->user->notifications()->count() > 0)
                    <div wire:click="deleteReadNotifications()" class="block cursor-pointer px-4 py-2 text-xs text-gray-400">
                        {{ __('@i18n-groups::notifications.delete_read_notifications') }}
                    </div>
                @endif

                @foreach ($userNotifications as $notification)
                    @if(null !== $notification->read_at)
                        <div class="w-full p-3 mt-1 bg-white dark:bg-gray-800 rounded flex items-center">
                            <div tabindex="0" class="focus:outline-none size-8 border rounded-full border-gray-200 dark:border-gray-600 flex shrink-0 items-center justify-center">
                                <x-icon class="size-5 text-gray-600 dark:text-gray-200" name="{{ $notification->data['icon'] }}" />
                            </div>
                            <div class="pl-3 cursor-pointer" wire:click="readNotification({{ $notification }})">
                                <p tabindex="0" class="focus:outline-none text-sm leading-none text-gray-600 dark:text-gray-200">{{ $notification->data['username'] }} {{ __('@i18n-groups::notifications.'. $notification->data['action_translated']) }}.</p>
                                @if(isset($notification->data['from']) && !isset($notification->data['to']))
                                    <p tabindex="0" class="focus:outline-none text-sm leading-none text-gray-800 dark:text-gray-400"> {{ __('@i18n-groups::notifications.date_changed_from') }} {{ \Carbon\Carbon::parse($notification->data['from'])->format('d M Y') }}</p>
                                @endif
                                @if(isset($notification->data['from']) && isset($notification->data['to']))
                                    <p tabindex="0" class="focus:outline-none text-sm leading-none text-gray-800 dark:text-gray-400"> {{ __('@i18n-groups::notifications.date_changed_from') }} {{ \Carbon\Carbon::parse($notification->data['from'])->format('d M Y') }} {{ __('@i18n-groups::notifications.to') }} {{ \Carbon\Carbon::parse($notification->data['to'])->format('d M Y') }}</p>
                                @endif
                                @if(isset($notification->data['to']) && !isset($notification->data['to']))
                                    <p tabindex="0" class="focus:outline-none text-sm leading-none text-gray-800 dark:text-gray-400"> {{ __('@i18n-groups::notifications.to') }} {{ \Carbon\Carbon::parse($notification->data['to'])->format('d M Y') }}</p>
                                @endif
                                <p tabindex="0" class="focus:outline-none text-xs leading-3 pt-1 text-gray-500 dark:text-gray-100">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @else
                        <div class="w-full p-3 mt-1 bg-green-100 dark:bg-green-400 rounded flex items-center">
                            <div tabindex="0" class="focus:outline-none size-8 border rounded-full border-green-200 dark:border-green-500 flex shrink-0 items-center justify-center">
                                <x-icon class="size-5 text-green-700" name="{{ $notification->data['icon'] }}" />
                            </div>
                            <div class="pl-3 cursor-pointer" wire:click="readNotification({{ $notification }})">
                                <p tabindex="0" class="focus:outline-none text-sm leading-none text-green-700">{{ $notification->data['username'] }} {{ __('@i18n-groups::notifications.'. $notification->data['action_translated']) }}</p>
                                @if(isset($notification->data['from']) && !isset($notification->data['to']))
                                    <p tabindex="0" class="focus:outline-none text-sm leading-none text-gray-800 dark:text-gray-400"> {{ __('@i18n-groups::notifications.date_changed_from') }} {{ \Carbon\Carbon::parse($notification->data['from'])->format('d M Y') }}</p>
                                @endif
                                @if(isset($notification->data['from']) && isset($notification->data['to']))
                                    <p tabindex="0" class="focus:outline-none text-sm leading-none text-gray-800 dark:text-gray-400"> {{ __('@i18n-groups::notifications.date_changed_from') }} {{ \Carbon\Carbon::parse($notification->data['from'])->format('d M Y') }} {{ __('@i18n-groups::notifications.to') }} {{ \Carbon\Carbon::parse($notification->data['to'])->format('d M Y') }}</p>
                                @endif
                                @if(isset($notification->data['to']) && !isset($notification->data['to']))
                                    <p tabindex="0" class="focus:outline-none text-sm leading-none text-gray-800 dark:text-gray-400"> {{ __('@i18n-groups::notifications.to') }} {{ \Carbon\Carbon::parse($notification->data['to'])->format('d M Y') }}</p>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="p-3 mt-4">
                    {{ $userNotifications->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
