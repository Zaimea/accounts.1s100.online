<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('@i18n-groups::profile.update_password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('@i18n-groups::profile.update_password_description') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('@i18n-groups::profile.current_password') }}" />
            <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('@i18n-groups::profile.new_password') }}" />
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('@i18n-groups::profile.confirm_password') }}" />
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('@i18n-groups::profile.saved') }}.
        </x-action-message>

        <x-button>
            {{ __('@i18n-groups::profile.save') }}
        </x-button>
    </x-slot>
</x-form-section>
