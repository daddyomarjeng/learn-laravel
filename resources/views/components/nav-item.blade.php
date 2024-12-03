@props(['isActive' => false, 'type' => 'a'])

@if ($type === 'a')
    <a class="{{ $isActive ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium"
        aria-current="{{ $isActive ? 'page' : 'false' }}" {{ $attributes }}>
        {{ $slot }}

    </a>
@else
    <button
        class="{{ $isActive ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium"
        aria-current="{{ $isActive ? 'page' : 'false' }}" {{ $attributes }}>
        {{ $slot }}

    </button>
@endif
