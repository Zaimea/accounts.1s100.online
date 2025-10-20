@props(['disabled' => false])

<div class="relative h-10 w-full min-w-[200px]">
    <div class="absolute top-2/4 right-3 grid h-5 w-5 -translate-y-2/4 place-items-center text-gray-600 dark:text-gray-400">
        <x-heroicons::outline.document-magnifying-glass />
    </div>
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'pl-6 block w-full rounded-lg border-2 border-gray-300 dark:border-gray-700 px-3 py-2 font-sans text-sm leading-5 dark:text-gray-500 focus:border-indigo-600 focus:outline-none dark:bg-gray-900 text-gray-600 dark:placeholder:text-gray-600']) !!}>
</div>
