@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="bg-white dark:bg-gray-800 py-2">
        <div class="flex justify-center">
            {{ $content }}
        </div>
    </div>
</x-modal>
