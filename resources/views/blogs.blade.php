<x-layout>
    <x-slot:heading>
        Blogs Page
    </x-slot:heading>
    <ul>
        @foreach ($blogs as $blog)
            <li class="leading-2">
                <a href="/blogs/{{ $blog['id'] }}">
                    <strong>{{ $blog['title'] }}</strong> - Written by: {{ $blog['user_id'] }}
                </a>
            </li>
        @endforeach
    </ul>
</x-layout>
