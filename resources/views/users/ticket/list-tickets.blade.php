<div>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1 flex justify-between">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('@i18n-groups::ticket.tickets') }}</h3>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('@i18n-groups::ticket.tickets_description') }}
                </p>
                <button class="cursor-pointer text-indigo-500 px-1" wire:click="createTicket()">
                    {{ __('@i18n-groups::ticket.create_a_new_ticket') }}
                </button>
            </div>
        </div>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="px-4 py-5 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="space-y-6 text-xs md:text-sm">
                    <x-action-message class="mr-3 text-indigo-400 dark:text-indigo-600" on="updated">
                        {{ __('@i18n-groups::ticket.updated') }}.
                    </x-action-message>
                    <x-action-message class="mr-3 text-indigo-400 dark:text-indigo-600" on="approved">
                        {{ __('@i18n-groups::ticket.approved') }}.
                    </x-action-message>
                    <x-action-message class="mr-3 text-indigo-400 dark:text-indigo-600" on="disapproved">
                        {{ __('@i18n-groups::ticket.disapproved') }}.
                    </x-action-message>
                    <div class="grid grid-cols-5 gap-1 items-center justify-between">
                        <div class="break-all dark:text-white">
                            {{ __(('@i18n-groups::ticket.subject')) }}
                        </div>
                        <div class="break-all dark:text-white">
                            {{ __(('@i18n-groups::ticket.category')) }}
                        </div>
                        <div class="break-all dark:text-white">
                            {{ __(('@i18n-groups::ticket.priority')) }}
                        </div>
                        <div class="break-all dark:text-white">
                            {{ __(('@i18n-groups::ticket.status')) }}
                        </div>
                        <div class="break-all dark:text-white">
                            {{ __(('@i18n-groups::ticket.actions')) }}
                        </div>
                    </div>
                    @forelse ($this->tickets as $ticket)
                        <div class="grid grid-cols-5 gap-1 items-center justify-between">
                            <div class="break-all dark:text-white">
                                {{ $ticket->subject }}
                            </div>
                            <div class="break-all dark:text-white">
                                {{ $ticket->category->category }}
                            </div>
                            <div class="break-all dark:text-white">
                                {{ $ticket->priority->priority }}
                            </div>
                            <div class="break-all dark:text-white">
                                {{ $ticket->status }}
                            </div>
                            <div class="flex items-center ml-2">
                                <button class="cursor-pointer text-indigo-500 px-1" wire:click="goToTicket({{ $ticket->id }})">
                                    {{ __('@i18n-groups::ticket.link_to_ticket') }}
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="grid grid-cols-auto gap-1 items-center justify-between">
                            <div class="break-all dark:text-white">
                                {{ __('@i18n-groups::ticket.there_are_no_tickets') }}
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
