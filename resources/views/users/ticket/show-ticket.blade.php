<div>
    <div class="space-y-8">
        <div class="flex lg:space-x-5 overflow-hidden relative rtl:space-x-reverse">
            <div class="h-full">
                <div class="relative p-0 h-full overflow-hidden m-2">
                    <div class="border-b border-slate-100 dark:border-slate-700 pb-4">
                         {{-- BEGIN: Profile --}}
                        <header>
                            <div class="flex px-6">
                                <div class="flex-1">
                                    <div class="flex space-x-3 rtl:space-x-reverse">
                                        <div class="flex-none">
                                            <div class="size-10 rounded-full">
                                                @if (\Zaimea\Groups\Fabric\Features::managesProfilePhotos())
                                                    <img class="size-full rounded-full object-cover"
                                                        src="{{ $this->user->profile_photo_url }}"
                                                        alt="{{ $this->user->name }}" />
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex-1 text-start">
                                            <span
                                                class="block text-slate-800 dark:text-slate-300 text-sm font-medium mb-[2px]">
                                                {{ $this->user->name }}
                                                <span
                                                    class="status bg-success-500 inline-block size-[10px] rounded-full ml-3"></span>
                                            </span>
                                            <span
                                                class="block text-slate-500 dark:text-slate-300 text-xs font-normal">
                                                {{ __('@i18n-groups::ticket.ticket_creator') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </header>
                         {{-- END: Profile --}}
                    </div>
                     {{-- end profile --}}

                    <ul class="list-item mt-5 space-y-4 border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                        <li
                            class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-none">
                            <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                <iconify-icon
                                    icon="heroicons-outline:location-marker"></iconify-icon>
                                <span>{{ __('@i18n-groups::ticket.subject') }}</span>
                            </div>
                            <div>
                                <span class="capitalize">{{ $this->ticket->subject }}</span>
                            </div>
                        </li>
                        <li
                            class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-none">
                            <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                <iconify-icon icon="heroicons-outline:user"></iconify-icon>
                                <span>{{ __('@i18n-groups::ticket.status') }}</span>
                            </div>
                            <div>
                                <span class="capitalize">{{ $this->ticket->status }}</span>
                            </div>
                        </li>
                        <li
                            class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-none">
                            <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                <iconify-icon icon="heroicons-outline:user"></iconify-icon>
                                <span>{{ __('@i18n-groups::ticket.category') }}</span>
                            </div>
                            <div>
                                <span class="capitalize">{{ $this->ticket->category->category }}</span>
                            </div>
                        </li>
                        <li
                            class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-none">
                            <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                <iconify-icon icon="ion:language-outline"></iconify-icon>
                                <span>{{ __('@i18n-groups::ticket.priority') }}</span>
                            </div>
                            <div>
                                <span class="capitalize">{{ $this->ticket->priority->priority }}</span>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-item mt-5 space-y-4 border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                        <li class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-none">
                            <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                <iconify-icon
                                    icon="heroicons-outline:location-marker"></iconify-icon>
                                <span>{{ __('@i18n-groups::ticket.description') }}</span>
                            </div>
                        </li>
                        <li class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-none">
                            <div class="mx-1 max-w-sm">
                                <span class="capitalize">{{ $this->ticket->description }}</span>
                            </div>
                        </li>
                    </ul>
                    <h4 class="py-4 text-sm text-secondary-500 dark:text-slate-300 font-normal">
                        {{ __('@i18n-groups::ticket.shared_documents') }}</h4>
                    <ul class="grid grid-cols-3 gap-2">
                        @isset ($this->ticket->file)
                            <li class="size-[46px]">
                                <img src="{{ asset("storage/".$this->ticket->file) }}"
                                    alt="" class="cursor-pointer size-full object-cover rounded-[3px]"
                                    wire:click="toPreviewFile('{{ asset("storage/".$this->ticket->file) }}')"
                                >
                            </li>
                        @endisset

                        @if ($this->ticket->hasComments())
                            @foreach ($this->ticket->comments as $file)
                                @isset($file->file)
                                    <li class="size-[46px]">
                                        <img src="{{ asset("storage/".$file->file) }}"
                                            alt="" class="cursor-pointer size-full object-cover rounded-[3px]"
                                            wire:click="toPreviewFile('{{ asset("storage/".$file->file) }}')"
                                        >
                                    </li>
                                @endisset
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
             {{-- main chat box --}}
            <div class="flex-1">
                <div class="flex space-x-5 h-full rtl:space-x-reverse">
                     {{-- end main message body --}}
                    <div class="flex-1">
                        <div class="h-full">
                            <div wire:poll.10s class="p-0">
                                @if ($this->ticket->hasComments())
                                    <div class="bg-white dark:bg-slate-800">
                                        <div class="overflow-y-auto pt-6 space-y-6">
                                            @foreach ($this->messages as $comment)
                                                @if (isset($this->agent) && $comment->user_id == $this->agent->id)
                                                     {{-- Agent --}}
                                                    <div class="block md:px-6 px-4">
                                                        <div class="flex space-x-2 items-start justify-end group w-full rtl:space-x-reverse">
                                                            <div class="no flex space-x-4 rtl:space-x-reverse">
                                                                <div class="break-all">
                                                                    <div class="text-contrent p-3 bg-slate-300 dark:bg-slate-900 dark:text-slate-300 text-slate-800 text-sm font-normal rounded-md flex-1 mb-1">
                                                                        {{ $comment->message }}
                                                                    </div>
                                                                    <span class="font-normal text-xs text-slate-400">
                                                                        {{ $comment->created_at->diffForHumans() }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="flex-none">
                                                                <div class="size-8 rounded-full">
                                                                    @if (\Zaimea\Groups\Fabric\Features::managesProfilePhotos())
                                                                        <img class="block size-full rounded-full object-cover"
                                                                            src="{{ $this->agent->profile_photo_url }}"
                                                                            alt="{{ $this->agent->name }}" />
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif ($comment->user_id == $this->user->id)
                                                     {{-- User --}}
                                                    <div class="block md:px-6 px-4">
                                                        <div class="flex space-x-2 items-start group rtl:space-x-reverse">
                                                            <div class="flex-none">
                                                                <div class="size-8 rounded-full">
                                                                    @if (\Zaimea\Groups\Fabric\Features::managesProfilePhotos())
                                                                        <img class="block size-full rounded-full object-cover"
                                                                            src="{{ $this->user->profile_photo_url }}"
                                                                            alt="{{ $this->user->name }}" />
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="flex-1 flex space-x-4 rtl:space-x-reverse">
                                                                <div>
                                                                    <div class="p-3 bg-slate-100 dark:bg-slate-600 dark:text-slate-300 text-slate-600 text-sm font-normal mb-1 rounded-md flex-1 break-all">
                                                                        {{ $comment->message }}
                                                                    </div>
                                                                    <span class="font-normal text-xs text-slate-400 dark:text-slate-400">
                                                                        {{ $comment->created_at->diffForHumans() }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                     {{-- message --}}
                                    @if ('closed' !== $this->ticket->status)
                                        <form wire:submit="sendMessage">
                                            <footer class="md:px-6 px-4 sm:flex md:space-x-4 sm:space-x-2 rtl:space-x-reverse border-t md:pt-6 pt-4 border-slate-100 dark:border-slate-700">
                                                <div class="flex-1 relative flex space-x-3 rtl:space-x-reverse">
                                                    <div x-data="{fileName: null, filePreview: null}" class="flex-none">
                                                         {{-- Upload File Input --}}
                                                        <input type="file" class="hidden"
                                                                    wire:model.live="fileToUpload"
                                                                    x-ref="fileToUpload"
                                                                    x-on:change="
                                                                            fileName = $refs.fileToUpload.files[0].name;
                                                                            const reader = new FileReader();
                                                                            reader.onload = (e) => {
                                                                                filePreview = e.target.result;
                                                                            };
                                                                            reader.readAsDataURL($refs.fileToUpload.files[0]);
                                                                    " />

                                                        <x-secondary-button class="m-2" type="button" x-on:click.prevent="$refs.fileToUpload.click()">
                                                            <x-icon name="cloud-arrow-up" />
                                                        </x-secondary-button>

                                                         {{-- New File Preview --}}
                                                        <div class="m-2 cursor-pointer" x-show="filePreview" style="display: none;"
                                                            wire:click="toPreviewFile('{{ $this->fileToUpload ? $this->fileToUpload->temporaryUrl() : '' }}')"
                                                        >
                                                            <span class="block rounded-full size-20 bg-cover bg-no-repeat bg-center"
                                                                    x-bind:style="'background-image: url(\'' + filePreview + '\');'">
                                                            </span>
                                                        </div>

                                                        <x-input-error for="file" class="mt-2" />
                                                    </div>
                                                    <div class="flex-1">
                                                        <x-textarea type="text" class="w-full" placeholder="{{ __('@i18n-groups::ticket.type_your_message') }}" wire:model="ticketMessage"/>
                                                    </div>
                                                    <div class="flex-none m-2">
                                                        <x-button>
                                                            <x-icon name="arrow-right-circle" />
                                                        </x-button>
                                                    </div>
                                                </div>
                                            </footer>
                                        </form>
                                    @endif
                                     {{-- end footer --}}
                                @else
                                    <div class="bg-white dark:bg-slate-800">
                                        <div class="overflow-y-auto pt-6 space-y-6">
                                            <div class="h-full flex flex-col items-center justify-center xl:space-y-2 space-y-6">
                                                <svg width="71px" height="71px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path d="M9.5 9.4185L14.5 14.4185M14.5 9.4185L9.5 14.4185M21.0039 12C21.0039 16.9706 16.9745 21 12.0039 21C9.9675 21 3.00463 21 3.00463 21C3.00463 21 4.56382 17.2561 3.93982 16.0008C3.34076 14.7956 3.00391 13.4372 3.00391 12C3.00391 7.02944 7.03334 3 12.0039 3C16.9745 3 21.0039 7.02944 21.0039 12Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </g>
                                                </svg>
                                                <h4 class="text-2xl text-slate-600 dark:text-slate-300 font-medium">
                                                    {{ __('@i18n-groups::ticket.no_message_yet') }}
                                                </h4>
                                                <div class="text-sm text-slate-500 lg:pt-0 pt-4">
                                                    <span class="lg:block hidden">
                                                        {{ __('@i18n-groups::ticket.don\'_worry') }}
                                                    </span>
                                                </div>
                                                 {{-- message --}}
                                                @if ('closed' !== $this->ticket->status)
                                                    <form class="w-full" wire:submit="sendMessage">
                                                        <footer class="md:px-6 px-4 sm:flex md:space-x-4 sm:space-x-2 rtl:space-x-reverse border-t md:pt-6 pt-4 border-slate-100 dark:border-slate-700">
                                                            <div class="flex-1 relative flex space-x-3 rtl:space-x-reverse">
                                                                <div x-data="{fileName: null, filePreview: null}" class="flex-none">
                                                                     {{-- Upload File Input --}}
                                                                    <input type="file" class="hidden"
                                                                                wire:model.live="fileToUpload"
                                                                                x-ref="fileToUpload"
                                                                                x-on:change="
                                                                                        fileName = $refs.fileToUpload.files[0].name;
                                                                                        const reader = new FileReader();
                                                                                        reader.onload = (e) => {
                                                                                            filePreview = e.target.result;
                                                                                        };
                                                                                        reader.readAsDataURL($refs.fileToUpload.files[0]);
                                                                                " />

                                                                    <x-secondary-button class="m-2" type="button" x-on:click.prevent="$refs.fileToUpload.click()">
                                                                        <x-icon name="cloud-arrow-up" />
                                                                    </x-secondary-button>

                                                                     {{-- New File Preview --}}
                                                                    <div class="m-2 cursor-pointer" x-show="filePreview" style="display: none;"
                                                                        wire:click="toPreviewFile('{{ $this->fileToUpload ? $this->fileToUpload->temporaryUrl() : '' }}')"
                                                                    >
                                                                        <span class="block rounded-full size-20 bg-cover bg-no-repeat bg-center"
                                                                                x-bind:style="'background-image: url(\'' + filePreview + '\');'">
                                                                        </span>
                                                                    </div>

                                                                    <x-input-error for="file" class="mt-2" />
                                                                </div>
                                                                <div class="flex-1">
                                                                    <x-textarea type="text" class="w-full" placeholder="{{ __('@i18n-groups::ticket.type_your_message') }}" wire:model="ticketMessage"/>
                                                                </div>
                                                                <div class="flex-none m-2">
                                                                    <x-button>
                                                                        <x-icon name="arrow-right-circle" />
                                                                    </x-button>
                                                                </div>
                                                            </div>
                                                        </footer>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                     {{-- right info bar --}}
                    <div class="flex-none w-[285px]">
                        <div class="h-full ml-2">
                            <div class="p-0 h-full">
                                <div class="h-full">
                                    @isset($this->agent)
                                        <div class="size-[100px] rounded-full mx-auto mb-4">
                                            @if (\Zaimea\Groups\Fabric\Features::managesProfilePhotos())
                                                <img class="block size-full rounded-full object-cover"
                                                    src="{{ $this->agent->profile_photo_url }}"
                                                    alt="{{ $this->agent->name }}" />
                                            @endif
                                        </div>
                                        <div class="text-center">
                                            <h5 class="text-base text-slate-600 dark:text-slate-300 font-medium mb-1">
                                                {{ $this->agent->name }}
                                            </h5>
                                        </div>
                                        <ul class="list-item mt-5 space-y-4 border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                                            <li
                                                class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-none">
                                                <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                    <iconify-icon
                                                        icon="heroicons-outline:location-marker"></iconify-icon>
                                                    <span>{{ __('@i18n-groups::ticket.agent_roles') }}</span>
                                                </div>
                                                <div class="text-xs">
                                                    @foreach ($this->agent->roles as $role)
                                                        <span class="p-1 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 rounded capitalize">
                                                            {{ $role->title }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </li>
                                        </ul>
                                        <ul
                                            class="list-item mt-5 space-y-4 border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                                            <li
                                                class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-none">
                                                <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                    <iconify-icon
                                                        icon="heroicons-outline:location-marker"></iconify-icon>
                                                    <span>{{ __('@i18n-groups::ticket.location') }}</span>
                                                </div>
                                                <div class="font-medium">{{ $ticket->user->country }}
                                                    {{ $this->agent->town }}
                                                </div>
                                            </li>
                                            <li
                                                class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-none">
                                                <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                    <iconify-icon icon="heroicons-outline:user"></iconify-icon>
                                                    <span>{{ __('@i18n-groups::ticket.member_since') }}</span>
                                                </div>
                                                <div class="font-medium">
                                                    {{ $this->agent->created_at->format('d M Y') }}
                                                </div>
                                            </li>
                                            <li
                                                class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-none">
                                                <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                    <iconify-icon icon="ion:language-outline"></iconify-icon>
                                                    <span>{{ __('@i18n-groups::ticket.language') }}</span>
                                                </div>
                                                <div class="font-medium">
                                                    {{ $this->agent->language }}
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="list-item space-y-3 border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6 mt-5">
                                            <li
                                                class="flex justify-between text-sm text-slate-600 dark:text-slate-300 leading-none">
                                                <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                    <iconify-icon icon="bxl:facebook-circle"></iconify-icon>
                                                    <span>{{ __('@i18n-groups::ticket.website') }}</span>
                                                </div>
                                                <div class="font-medium">
                                                    {{ $this->agent->website }}</div>
                                            </li>
                                        </ul>
                                    @else
                                        <div class="text-center">
                                            <h5 class="text-base text-slate-600 dark:text-slate-300 font-medium mb-1">
                                                {{ __('@i18n-groups::ticket.there_is_no_agent_yet') }}
                                            </h5>
                                        </div>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-image-preview-modal wire:model.live="previewModal">
        <x-slot name="content">
            @if ($fileToPreview)
                <img class="max-h-screen" src="{{ $fileToPreview }}">
            @endif
        </x-slot>
    </x-image-preview-modal>
</div>
