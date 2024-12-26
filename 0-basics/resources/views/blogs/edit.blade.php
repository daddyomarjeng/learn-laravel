<x-layout>
    <x-slot:heading>
        Edit Blog Post
    </x-slot:heading>
    <form method="POST" action="/blogs/{{ $blog->id }}">
        @csrf
        @method('PUT') <!-- Spoofs a PUT request -->
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Edit Blog Post</h2>
                <p class="mt-1 text-sm/6 text-gray-600">This information will be displayed publicly so be careful what
                    you write.</p>

                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-600 text-sm my-4 italic">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
                        <div class="mt-2">
                            <div
                                class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">

                                <input type="text" name="title" id="title"
                                    class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                                    placeholder="How to create a laravel app" value="{{ old('title', $blog->title) }}">
                            </div>
                            @error('title')
                                <p class="text-red-600 text-sm mt-2 italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="content" class="block text-sm/6 font-medium text-gray-900">Content</label>
                        <div class="mt-2">
                            <textarea name="content" id="content" rows="3"
                                class="block w-full rounded-md bg-white py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6
                                ">
                                {{ old('content', $blog->content) }}
                            </textarea>
                        </div>
                        @error('content')
                            <p class="text-red-600 text-sm mt-2 italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>



        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/blogs/{{ $blog->id }}" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Updat
                e</button>
        </div>
    </form>

</x-layout>