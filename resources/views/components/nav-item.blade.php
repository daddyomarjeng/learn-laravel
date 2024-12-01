{{-- isActive prop with a default value of false --}}
@props(["isActive"=> false])

<a @class(['bg-red-600 text-white'=> $isActive, 'ml-4 text-sm']) {{ $attributes }}>
{{ $slot }}
</a>
