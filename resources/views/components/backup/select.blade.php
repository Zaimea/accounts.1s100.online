@props(['disabled' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block w-full rounded-lg border-2 border-gray-300 dark:border-gray-700 px-3 py-2 font-sans text-sm leading-5 dark:text-gray-500 focus:border-indigo-600 focus:outline-none dark:bg-gray-900 text-gray-600 dark:placeholder:text-gray-600']) !!}>
    {{ $options }}
</select>
