> # Learn Laravel

-   Installations and Documentation: https://laravel.com/docs/11.x/installation

-   Creating a new laravel Project

```bash
laravel new  project-name
```

# Database Connection

-   In env you can setup your database connection

## Using sqlite

-   Create file called database.sqlite in this folder as database/database.sqlite
-   Open the .env file and change MySQL to SQLite
-   Comment password and username and databaseName
-   run php artisan migrate enjoy

```env
DB_CONNECTION=sqlite

#DB_HOST=127.0.0.1
#DB_PORT=3306
#DB_DATABASE=database
#DB_USERNAME=doj
#DB_PASSWORD=password
```

-   If you do not have sqlite installed, you can install using the folklowing command:

```bash
sudo apt-get install php-sqlite3
```

# Routes

-   They can be for console, web and apis,
-   They take in the path that the user wants to access and returns a callback function containing the result
-   The web returns a method called **View** which takes in the name of the view you want to display

    -   All Views are in the **resources/views** directory

-   Example of web routes:

```php
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
```

-   If your application will also offer a stateless API, you may enable API routing using the install:api Artisan command:

```bash
php artisan install:api
```

# Components

-   Components are any kind of reusable blocks that can be references in multiple places around you application. Eg: _Menu, Dropdowns, buttons, layouts, etc.._
-   They can be found in **resources/views/components**
-   The folder name has to be spelled correctly, like **components**
-   Their is a global variable available in component files called **slot** that we can you to display anything that is wrapped withing the componet
    -   You can use the php echo to display it or you can use blade template helper, which enables you to call variables by wrapping them between four curly brackets.
    -   Under the hood, blade transforms the content within the brackets as echo whatever is inside the brackets.
-   To use a component in another file you will have to prefix the name of the component with **x-** to tell laravel that it is a component and for it to look for the file in the component folder
-   Example Layout File:

```php
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
```

-   Exaple using the component

```php
<x-layout>
    <h1>Home Page</h1>
</x-layout>
```
