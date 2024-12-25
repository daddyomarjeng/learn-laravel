{{-- <a @class(['bg-red-600 text-white'=> $isActive, 'ml-4 text-sm']) {{ $attributes }}>
    {{ $slot }}
</a> --}}

{{-- isActive prop with a default value of false --}}
@props(['isActive' => false])
<a class="{{ $isActive ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium"
    aria-current="{{ $isActive ? 'page' : 'false' }}" {{ $attributes }}>
    {{ $slot }}

</a>
