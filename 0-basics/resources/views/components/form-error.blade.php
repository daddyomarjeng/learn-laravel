@props(['name'])

@error($name)
    <p class="text-red-600 text-sm mt-2 italic">{{ $message }}</p>
@enderror
