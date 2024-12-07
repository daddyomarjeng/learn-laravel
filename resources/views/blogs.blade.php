<x-layout>
    <x-slot:heading>
        Blogs Page
    </x-slot:heading>
    @foreach ($blogs as $blog)
        <li class="leading-2"><strong>{{ $blog['title'] }}</strong> - Written by: {{ $blog['author'] }}</li>
    @endforeach
</x-layout>
