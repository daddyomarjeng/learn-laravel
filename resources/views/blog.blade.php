<x-layout>
    <x-slot:heading>
        Blog Page
    </x-slot:heading>
    <h2 class="font-bold">{{ $blog['title'] }}</h2>

    <p class="my-8 text-sm">
        {{ $blog['content'] }}
    </p>
    <span class="text-gray-400"><strong class="text-gray-700">Author:</strong> {{ $blog['author'] }}</span>
</x-layout>
