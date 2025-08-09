<div>
     {{-- Create Category  --}}
    <x-form-section submit="create">
        <x-slot name="title">
            {{ __('@i18n-groups::ticket.create_ticket') }}
        </x-slot>

        <x-slot name="description">
            {{ __('@i18n-groups::ticket.create_ticket_description') }}
        </x-slot>

        <x-slot name="form">
             {{-- Subject --}}
            <div class="col-span-6 sm:col-span-4">
                <x-label for="subject" value="{{ __('@i18n-groups::ticket.subject') }}" />
                <x-input id="subject" type="text" class="mt-1 block w-full" wire:model="createTicket.subject" placeholder="{{ __('@i18n-groups::ticket.subject') }}" />
                <x-input-error for="subject" class="mt-2" />
            </div>
             {{-- Description --}}
            <div class="col-span-6 sm:col-span-4">
                <x-label for="description" value="{{ __('@i18n-groups::ticket.description') }}" />
                <x-input id="description" type="text" class="mt-1 block w-full" wire:model="createTicket.description" placeholder="{{ __('@i18n-groups::ticket.description') }}" />
                <x-input-error for="description" class="mt-2" />
            </div>
             {{-- Category --}}
            <div class="col-span-6 sm:col-span-4">
                <x-label for="category_id" value="{{ __('@i18n-groups::ticket.category') }}" />
                <x-select id="category_id" name="categorylist" form="category_id"
                    wire:model="createTicket.category_id" autocomplete="category">
                    <x-slot name="options">
                        <option >{{ __('@i18n-groups::ticket.select_category') }}</option>
                        @foreach ($this->categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category }}</option>
                        @endforeach
                    </x-slot>
                </x-select>
                <x-input-error for="category_id" class="mt-2" />
            </div>
             {{-- Priority --}}
            <div class="col-span-6 sm:col-span-4">
                <x-label for="priority_id" value="{{ __('@i18n-groups::ticket.priority') }}" />
                <x-select id="priority_id" name="prioritylist" form="priority_id"
                    wire:model="createTicket.priority_id" autocomplete="priority"
                >
                    <x-slot name="options">
                        <option>{{ __('@i18n-groups::ticket.select_priority') }}</option>
                        @foreach ($this->priorities as $priority)
                            <option value="{{ $priority->id }}">{{ $priority->priority }}</option>
                        @endforeach
                    </x-slot>
                </x-select>
                <x-input-error for="priority_id" class="mt-2" />
            </div>
             {{-- File upload --}}
            <div class="col-span-6 sm:col-span-4">
                <x-label for="file" value="{{ __('@i18n-groups::ticket.file_upload') }}" />
                <x-input accept="image/png image/jpeg" id="file" type="file" class="mt-1 block w-full"
                    wire:model="fileToUpload"
                />
                <x-input-error for="file" class="mt-2" />
                @if ($fileToUpload)
                    <div class="cursor-pointer" wire:click="$toggle('previewFile')" wire:loading.attr="disabled">
                        <img class="mt-4 rounded size-[86px]" src="{{ $fileToUpload->temporaryUrl() }}">
                    </div>
                @endif
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="mr-3" on="created">
                {{ __('@i18n-groups::ticket.created') }}.
            </x-action-message>

            <x-button>
                {{ __('@i18n-groups::ticket.create') }}
            </x-button>
        </x-slot>
    </x-form-section>

    <x-image-preview-modal wire:model.live="previewFile">
        <x-slot name="content">
            @if ($fileToUpload)
                <img src="{{ $fileToUpload->temporaryUrl() }}">
            @endif
        </x-slot>
    </x-image-preview-modal>
</div>
