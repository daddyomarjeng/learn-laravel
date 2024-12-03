> # Learn Laravel

-   Installations and Documentation: https://laravel.com/docs/11.x/installation

-   Creating a new laravel Project

```bash
laravel new  project-name
```

# Database Connection

-   In env you can setup your database connection

## Using sqlite

-   if you prefer to use sqlite
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

-   Components are any kind of reusable blocks that can be referenced in multiple places around your application. Eg: _Menu, Dropdowns, buttons, layouts, etc.._
-   They can be found in **resources/views/components**
-   The folder name has to be spelled correctly, like **components**
-   Their is a global variable available in component files called **slot** that we can use to display anything that is wrapped withing the componet
    -   You can use the php echo to display it or you can use blade template helper, which enables you to call variables by wrapping them between four curly brackets.
    -   Under the hood, blade transforms the content within the brackets as echo whatever is inside the brackets.
-   To use a component in another file you will have to prefix the name of the component with **x-** to tell laravel that it is a component and for it to look for the file in the component folder
-   Example Layout File:

```php
<!-- layout.blade.php -->
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

# Attributes, Props, & Conditional Classes(Styling)

-   **Attributes=>** All Lavarevl Components also have access to an **attributes object(HTML Attributes)**, example: _href, class, id, etc._ - You can access it by using the whole attributes passed or by getting only specific attribute:

    ```php
    //nav-item.blade.php
    <a {{ $attributes }}>
    {{ $slot }}
    </a>
    // or
    <a {{ $attributes->get("href") }}>
    {{ $slot }}
    </a>
    ```

    ```php
    // layout.blade.php
     <nav>
        <x-nav-item href="/">Home</x-nav-item>
        <x-nav-item href="/about">About</x-nav-item>
        <x-nav-item href="/contact">Contact</x-nav-item>
     </nav>
    ```

-   **Props=>** By default all values added to the component will be considered as attributes,
-   When we accept a prop into a component, the first thing we need to do is to declare the prop we are accepting at the top of the file by using a **blade directive called _@props_** and pass in it an array of props we want to accept and any default value we want to give to those props.
-   All props and attributes as considered as string values by default. If we want to assign variables or other values to them we can just add a column before the prop name which allows us to bind some dynamic value or data to the prop as it's value.
-   if we do not declare the prop at the top of the file, blade will assume that the prop is an attribute and will treat it like that.

-   **Conditional Classes=>** We can use conditional css classes in blade by using the blade directive: **@class**

```php
//nav-item.blade.php
// isActive prop with a default value of false
@props(["isActive"=> false])

<a @class(['bg-red-600 text-white'=> $isActive, 'ml-4 text-sm']) {{ $attributes }}>
{{ $slot }}
</a>

```

```php
// layout.blade.php
    <nav>
        <x-nav-item href="/" :isActive="true">Home</x-nav-item>
        <x-nav-item href="/about">About</x-nav-item>
        <x-nav-item href="/contact">Contact</x-nav-item>
    </nav>
```

# Slots

-   Slots can be considered as different areas where we paste in content
-   Like we learn earlier, we can use the variable **slot** to access anything wrapped within a component.
-   **Types of Slots=>** We have default slot and named slots.
    -   **Default Slot=>** This variable holds content of anything that is wrapped within the component
    -   **Named Slots=>** These are multiple slots that are identift by using names and can be accessed as variables in the component. We can pass a slot by preceeding it with: **x-slot:** and then followed by the slot name or variable.

```php
//layout.blade.php
  <header class="bg-white shadow">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $heading }}</h1>
      </div>
    </header>
    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      {{ $slot }}
      </div>
    </main>
```

```php
//home.blade.php
<x-layout>
    <x-slot:heading>
        Home Page
    </x-slot:heading>
    <h1>Hello from the Home Page</h1>
</x-layout>
```

# Get Current Page(path/url)

-   We can use the globally available request object in laravel to get access to the current path(url) of our app
-   We can use that to style or perform actions in our app

```php
// nav-item.blad.php
@props(["isActive"=> false])
<a
    class="{{ $isActive ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium"
    aria-current="{{ $isActive ? "page" : "false" }}"
    {{ $attributes }}
>
    {{ $slot }}
</a>

```

```php
// layout.blade.php
<div class="ml-10 flex items-baseline space-x-4">
    <x-nav-item href="/" :isActive="request()->is('/')">Home</x-nav-item>
    <x-nav-item href="/about" :isActive="request()->is('about')">About</x-nav-item>
    <x-nav-item href="/contact" :isActive="request()->is('contact')">Contact</x-nav-item>
</div>
```

# Conditionals

-   We can conditionally render elements using conditionals.
-   We can either use the traditional php method or use blade helper directives to achieve it.

```php
// Using Raw PHP
// nav-item.blade.php
@props(['isActive' => false, 'type' => 'a'])
<?php if($type==="a") : ?>
<a class="{{ $isActive ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium"
    aria-current="{{ $isActive ? 'page' : 'false' }}" {{ $attributes }}>
    {{ $slot }}

</a>
<?php else: ?>
<button
    class="{{ $isActive ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }} rounded-md px-3 py-2 text-sm font-medium"
    aria-current="{{ $isActive ? 'page' : 'false' }}" {{ $attributes }}>
    {{ $slot }}

</button>
<?php endif ?>

```

```php
// Using Blade Directives
// nav-item.blade.php
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


```
