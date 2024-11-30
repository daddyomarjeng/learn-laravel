<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>

    </head>
    <body class="">
        <nav>
            <a href="/">Home</a>
            <a href="">About</a>
            <a href="">Contact</a>
        </nav>

        {{-- <?php echo $slot; ?> --}}
        {{ $slot }}
    </body>
</html>
