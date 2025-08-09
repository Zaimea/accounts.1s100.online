<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('@i18n-groups::profile.profile_information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('@i18n-groups::profile.profile_information_description') }}
    </x-slot>

    <x-slot name="form">
         {{-- Profile Photo --}}
        @if (\Zaimea\Groups\Fabric\Features::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                 {{-- Profile Photo File Input --}}
                <input type="file" id="photo" class="hidden"
                            wire:model.live="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('@i18n-groups::profile.photo') }}" />

                 {{-- Current Profile Photo --}}
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full size-20 object-cover">
                </div>

                 {{-- New Profile Photo Preview --}}
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full size-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('@i18n-groups::profile.select_a_new_photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('@i18n-groups::profile.remove_photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

         {{-- Name --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('@i18n-groups::profile.name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

         {{-- Username--}}
         <div class="col-span-6 sm:col-span-4">
            <x-label for="username" value="{{ __('@i18n-groups::profile.username') }}" />
            <x-input id="username" type="text" class="mt-1 block w-full" wire:model="state.username" autocomplete="username" />
            <x-input-error for="username" class="mt-2" />
        </div>

         {{-- Email --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('@i18n-groups::profile.email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (\Zaimea\Groups\Fabric\Features::enabled(\Zaimea\Groups\Fabric\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2 dark:text-white">
                    {{ __('@i18n-groups::profile.your_email_address_is_unverified') }}

                    <button type="button" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" wire:click.prevent="sendEmailVerification">
                        {{ __('@i18n-groups::profile.click_here_to_resend_the-verification_email') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('@i18n-groups::profile.new_link_has_been_send') }}
                    </p>
                @endif
            @endif
        </div>

         {{-- User birthday --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="birthday" value="{{ __('@i18n-groups::profile.birthday') }}" />
            <x-input id="birthday" type="date" class="mt-1 block w-full" wire:model="state.birthday" autocomplete="birthday" title="{{ __('@i18n-groups::profile.provide_a_date') }}" />
            <x-input-error for="birthday" class="mt-2" />
        </div>

         {{-- Gender --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="gender" value="{{ __('@i18n-groups::profile.gender') }}" />
            <x-select id="gender" form="gender"
                wire:model="state.gender" autocomplete="gender">
                <x-slot name="options">
                    <option value="none">{{ __('@i18n-groups::profile.select_your_gender') }}</option>
                    <option value="male">{{ __('@i18n-groups::profile.male') }}</option>
                    <option value="female">{{ __('@i18n-groups::profile.female') }}</option>
                    <option value="divers">{{ __('@i18n-groups::profile.divers') }}</option>
                </x-slot>
            </x-select>
            <x-input-error for="gender" class="mt-2" />
        </div>

          {{-- Country --}}
         <div class="col-span-6 sm:col-span-4">
            <x-label for="country" value="{{ __('@i18n-groups::profile.country') }}" />
            <x-input id="country" type="text" class="mt-1 block w-full" wire:model="state.country" autocomplete="country" />
            <x-input-error for="country" class="mt-2" />
        </div>

         {{-- Town --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="town" value="{{ __('@i18n-groups::profile.town') }}" />
            <x-input id="town" type="text" class="mt-1 block w-full" wire:model="state.town" autocomplete="town" />
            <x-input-error for="town" class="mt-2" />
        </div>

         {{-- Website --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="website" value="{{ __('@i18n-groups::profile.website') }}" />
            <x-input id="website" type="text" class="mt-1 block w-full" wire:model="state.website"/>
            <x-input-error for="website" class="mt-2" />
        </div>

         {{-- About --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="about" value="{{ __('@i18n-groups::profile.about_myself') }}" />
            <x-input id="about" type="text" class="mt-1 block w-full" wire:model="state.about"/>
            <x-input-error for="about" class="mt-2" />
        </div>

         {{-- User Description --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="userdescription" value="{{ __('@i18n-groups::profile.description') }}" />
            <x-textarea id="userdescription" type="text" class="mt-1 block w-full" wire:model="state.userdescription"/>
            <x-input-error for="userdescription" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('@i18n-groups::profile.saved') }}.
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('@i18n-groups::profile.save') }}
        </x-button>
    </x-slot>
</x-form-section>
