<x-app-layout>
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="flex flex-col min-w-0 break-words bg-white dark:bg-gray-800 w-full mb-6 shadow-xl rounded-lg mt-16">
                <div class="px-6">
                  <div class="flex flex-wrap justify-center">
                    <div class="w-full px-4 flex justify-center">
                        <div class="mt-2" x-show="! photoPreview">
                            <img src="{{ $user->profile_photo_url }}" class="shadow-xl rounded-full h-auto align-middle border-none max-w-150-px">
                        </div>
                    </div>
                    <div class="w-full px-4 text-center mt-20">
                      <div class="flex justify-center py-4 lg:pt-4 pt-8">
                        <div class="mr-4 p-3 text-center">
                          <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                            22
                          </span>
                          <span class="text-sm text-blueGray-400">Friends</span>
                        </div>
                        <div class="mr-4 p-3 text-center">
                          <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                            10
                          </span>
                          <span class="text-sm text-blueGray-400">Photos</span>
                        </div>
                        <div class="lg:mr-4 p-3 text-center">
                          <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">
                            89
                          </span>
                          <span class="text-sm text-blueGray-400">Comments</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="text-center mt-12">
                    <h3 class="text-xl font-semibold leading-normal mb-2 text-blueGray-700">
                        {{ $user->name }}
                    </h3>
                    <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
                        <x-icon name="map-pin" />
                        {{ $user->country }}, {{ $user->town }}
                    </div>
                    <div class="mb-2 text-blueGray-600 mt-10">
                      <x-icon name="briefcase" />
                        @foreach ($user->allGroups() as $group)
                        <p class="mb-4 text-lg leading-relaxed text-blueGray-700">{{ __('Group:') }} {{ $group->name }} {{ __('Role: Owner') }}</p>
                        @endforeach
                    </div>
                  </div>
                  <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
                    <div class="flex flex-wrap justify-center">
                        <div class="w-full lg:w-9/12 px-4">
                            <p class="mb-4 text-lg leading-relaxed text-blueGray-700">
                                About me: {{ $user->about }}
                            </p>
                          </div>
                        <div class="w-full lg:w-9/12 px-4">
                            <p class="mb-4 text-lg leading-relaxed text-blueGray-700">
                                Description: {{ $user->userdescription }}
                            </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</x-app-layout>
