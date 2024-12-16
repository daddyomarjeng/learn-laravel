<x-layout>
    <x-slot:heading>
        Blog Page
    </x-slot:heading>
    <div class="flex items-center justify-between flex-wrap">
        <h2 class="font-bold">{{ $blog['title'] }}</h2>
        <x-button href="/blogs/{{ $blog->id }}/edit">Edit Post</x-button>
    </div>

    <p class="my-8 text-sm">
        {{ $blog['content'] }}
    </p>
    <div class="flex items-center justify-between flex-wrap">
        <span class="text-gray-400"><strong class="text-gray-700">Author:</strong> {{ $blog['author']->name }}</span>
        <form method="POST" action="/blogs/{{ $blog->id }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-800">Delet Post</butt>
        </form>
    </div>
</x-layout>
