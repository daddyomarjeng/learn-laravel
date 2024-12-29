<x-layout>
    <x-slot:heading>
        Create Blog Post
    </x-slot:heading>
    <form method="POST" action="/blogs">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Create Blog Post</h2>
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
                    <x-form-field>
                        <x-form-label for="title">Title</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="title" id="title" placeholder="How to create a laravel app"
                                value="{{ old('title') }}" />
                            <x-form-error name="title" />
                        </div>
                    </x-form-field>
                    <x-form-field>
                        <x-form-label for="content">Content</x-form-label>
                        <div class="mt-2">
                            <x-form-text-area name="content" id="content">
                                {{ old('content') }}
                            </x-form-text-area>
                            <x-form-error name="content" />
                        </div>
                    </x-form-field>

                </div>
            </div>
        </div>



        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
            <x-form-button>Save</x-form-button>
        </div>
    </form>

</x-layout>
