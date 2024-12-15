<x-layout>
    <x-slot:heading>
        Blogs Page
    </x-slot:heading>
    <ul>
        @foreach ($blogs as $blog)
            <li class="leading-2">
                <a href="/blogs/{{ $blog['id'] }}">
                    <strong>{{ $blog['title'] }}</strong> - Written by: {{ $blog->author->name }}
                    <br><span class="font-semibold text-sm">Tags:</span>
                    @foreach ($blog->tags as $tag)
                        <span>{{ $tag->name }}</span>
                    @endforeach
                </a>
            </li>
        @endforeach
    </ul>

    {{ $blogs->links() }}
</x-layout>
