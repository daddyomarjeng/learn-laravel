<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://cdn.tailwindcss.com"></script>
        <title>Home</title>

    </head>
    <body class="">
        <nav>
           <x-nav-item href="/" :isActive="true">Home</x-nav-item>
            <x-nav-item href="/about">About</x-nav-item>
            <x-nav-item href="/contact">Contact</x-nav-item>
        </nav>

        {{-- <?php echo $slot; ?> --}}
        {{ $slot }}
    </body>
</html>
