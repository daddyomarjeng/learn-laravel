# **Learn Laravel**

### **Installations and Documentation**

For a complete guide on installation, visit: [Laravel Official Documentation](https://laravel.com/docs/11.x/installation).

### **Creating a New Laravel Project**

To create a new Laravel project, use the following command:

```bash
laravel new project-name
```

> # PHP & LARAVEL TIPS

-   **dd function =>** means dump and die, dumps the data in the browser and then kills the execution.

```php
dd("DOJ")
```

-   **Laravel ARR class=>** is a laravel helper class that takes in an array and has a lot of other helper methods to help work with arrays. Eg.:

```php
   $post =  Arr::first($blogs, function($blog) {
        return $blog['id'] == 1;
    });
```

-   **Accessing outside data/variables in a closure=>** example if we want to access a variable in a function but the variable is declared outside the function. We have two ways to access it:
    -   **1. The 'use' function=>** eg use($id)
    ```php
      $post =  Arr::first($blogs, function($blog) use($id) {
        return $blog['id'] == $id;
    });
    ```
    -   **2. The 'fn' or 'arrow function'**
    ```php
    $post = ARR::first($blogs, fn($blog)=>$blog['id'] == $id);
    ```

# **Database Connection**

### **Setting Up Database Connection in `.env`**

You can configure your database connection in the `.env` file.

### **Using SQLite**

If you prefer to use SQLite:

1. Create a file named `database.sqlite` inside the `database/` directory.
2. Open the `.env` file and change the `DB_CONNECTION` value to `sqlite`.
3. Comment out the `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` entries.
4. Run the migration command:
    ```bash
    php artisan migrate
    ```
5. Enjoy your SQLite setup.

Example `.env` configuration for SQLite:

```env
DB_CONNECTION=sqlite

# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=database
# DB_USERNAME=doj
# DB_PASSWORD=password
```

### **Installing SQLite**

If SQLite is not installed, use the following command to install it:

```bash
sudo apt-get install php-sqlite3
```

# **Routes**

-   Laravel routes define the paths that users can access in your application. They support web, API, and console routes.

### **Web Routes**

-   Web routes typically return views using the `view()` method. All views are stored in the `resources/views` directory.

#### **Example: Defining Web Routes**

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

### **API Routing**

-   To enable API routing in your application, you can use the following command:

```bash
php artisan install:api
```

### **Route Wildcards (Dynamic Routes)**

-   Dynamic routes allow you to capture parameters directly from the URL by using placeholders in curly braces `{}`.

#### **Example: Single Wildcard**

```php
Route::get('/user/{id}', function ($id) {
    return "User ID: " . $id;
});
```

-   In this example, `{id}` is a placeholder that captures the dynamic value from the URL.
-   Accessing `/user/123` will return "User ID: 123".

#### **Example: Multiple Wildcards**

```php
Route::get('/post/{postId}/comment/{commentId}', function ($postId, $commentId) {
    return "Post ID: $postId, Comment ID: $commentId";
});
```

#### **Optional Wildcards**

-   Add a `?` to make a parameter optional, and provide a default value:

```php
Route::get('/user/{name?}', function ($name = 'Guest') {
    return "Hello, " . $name;
});
```

#### **Route Constraints**

-   You can restrict the values captured by a wildcard using the `where` method:

```php
Route::get('/user/{id}', function ($id) {
    return "User ID: " . $id;
})->where('id', '[0-9]+'); // Only numeric IDs are allowed
```

# **Components**

-   Laravel components are reusable blocks, such as menus, buttons, or layouts, that can be used throughout your application.

### **Directory**

-   All components should be stored in the `resources/views/components` directory. Ensure the folder name is spelled as `components`.

### **Using Components**

-   To use a component, prefix its name with `x-` in your Blade files. For example:
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

# Passing Data to Views

-   We can pass a second arguement to the view functions, which will be an array where each of the keys will be extracted into variables once the view or template is loaded

```php
// route/web.php
Route::get('/blogs', function () {
    $blogs = [
        [
            "title" => "Mastering Laravel Without Prior PHP Knowledge",
            "post" => "I started writing Laravel code with minimal PHP experience. To my surprise, it turned out to be much easier than I expected. Laravel's simplicity and extensive documentation made the journey enjoyable.",
            "author" => "Omar Jeng"
        ],
        [
            "title" => "Understanding Eloquent in Laravel",
            "post" => "Eloquent ORM simplifies database interactions in Laravel. Even without a deep understanding of SQL, its intuitive methods make handling data seamless and efficient.",
            "author" => "Aisha Conteh"
        ],
        [
            "title" => "Tips for Building REST APIs with Laravel",
            "post" => "Laravel makes building REST APIs straightforward. From routing to controllers and resource transformations, the framework ensures clean and maintainable API development.",
            "author" => "Lamin Sanyang"
        ],
        [
            "title" => "Deploying a Laravel Application",
            "post" => "Deploying a Laravel app can seem challenging at first, but tools like Forge and Vapor simplify the process. With proper configurations, you can get your app live in no time.",
            "author" => "Fatou Jobe"
        ],
    ];
    return view('blogs', ['blogs'=>$blogs]);
});
```

```php
// views/blogs.blade.php
<x-layout>
    <x-slot:heading>
        Blogs Page
    </x-slot:heading>
    <ul>
        @foreach ($blogs as $blog)
            <li class="leading-2">
                <a href="/blogs/{{ $blog['id'] }}">
                    <strong>{{ $blog['title'] }}</strong> - Written by: {{ $blog['author'] }}
                </a>
            </li>
        @endforeach
    </ul>
</x-layout>
```

# Route Wildcards (Dynamic Routes)

In Laravel, **route wildcards** (or dynamic routes) allow you to define routes with placeholders that can capture dynamic values from the URL. These placeholders are defined using curly braces `{}`.

For example:

```php
Route::get('/user/{id}', function ($id) {
    return "User ID: " . $id;
});
```

In this example:

-   `{id}` is a wildcard that captures the value from the URL.
-   When accessing `/user/123`, the `$id` parameter will hold the value `123`.

-   A moore real world example is:

```php
//  routes/web.php
Route::get('/blogs/{id}', function ($id) {
    $blogs = [
        [
            "id"=>1,
            "title" => "Mastering Laravel Without Prior PHP Knowledge",
            "post" => "I started writing Laravel code with minimal PHP experience. To my surprise, it turned out to be much easier than I expected. Laravel's simplicity and extensive documentation made the journey enjoyable.",
            "author" => "Omar Jeng"
        ],
        [
            "id"=>2,
            "title" => "Understanding Eloquent in Laravel",
            "post" => "Eloquent ORM simplifies database interactions in Laravel. Even without a deep understanding of SQL, its intuitive methods make handling data seamless and efficient.",
            "author" => "Aisha Conteh"
        ],
        [
            "id"=>3,
            "title" => "Tips for Building REST APIs with Laravel",
            "post" => "Laravel makes building REST APIs straightforward. From routing to controllers and resource transformations, the framework ensures clean and maintainable API development.",
            "author" => "Lamin Sanyang"
        ],
        [
            "id"=>4,
            "title" => "Deploying a Laravel Application",
            "post" => "Deploying a Laravel app can seem challenging at first, but tools like Forge and Vapor simplify the process. With proper configurations, you can get your app live in no time.",
            "author" => "Fatou Jobe"
        ],
    ];
//    $post =  Arr::first($blogs, function($blog) use($id) {
//         return $blog['id'] == $id;
//     });
    $post = ARR::first($blogs, fn($blog)=>$blog['id'] == $id);
    // dd($post);
    return view('blog', ['blog'=>$post]);
});
```

```php
// views/blog.blade.php
<x-layout>
    <x-slot:heading>
        Blog Page
    </x-slot:heading>
    <h2 class="font-bold">{{ $blog['title'] }}</h2>

    <p class="my-8 text-sm">
        {{ $blog['post'] }}
    </p>
    <span class="text-gray-400"><strong class="text-gray-700">Author:</strong> {{ $blog['author'] }}</span>
</x-layout>

```

### Key Features:

1. **Dynamic Parameters**: Wildcards let you capture data directly from the URL.
2. **Multiple Wildcards**: You can define multiple wildcards in the same route, like so:
    ```php
    Route::get('/post/{postId}/comment/{commentId}', function ($postId, $commentId) {
        return "Post ID: $postId, Comment ID: $commentId";
    });
    ```
3. **Optional Parameters**: Add a `?` after the parameter to make it optional, and provide a default value:
    ```php
    Route::get('/user/{name?}', function ($name = 'Guest') {
        return "Hello, " . $name;
    });
    ```

### Named Constraints:

You can restrict the type of values captured using route constraints:

```php
Route::get('/user/{id}', function ($id) {
    return "User ID: " . $id;
})->where('id', '[0-9]+'); // Only numeric IDs are allowed
```

# Autoload

-   In Laravel, **autoload** refers to the mechanism that allows PHP classes, interfaces, or traits to be loaded automatically when they are needed, without requiring manual `include` or `require` statements.

#### How It Works:

1. **Composer Autoloading**:

    - Laravel uses [Composer](https://getcomposer.org/), a dependency manager for PHP, to handle autoloading.
    - Composer generates a file (`vendor/autoload.php`) that automatically includes all classes based on their namespaces and file structure.
    - Laravel uses the **PSR-4 autoloading standard**, which maps namespaces directly to directory structures.

2. **Defining Autoload in `composer.json`**:

    - The `autoload` section in `composer.json` specifies the mapping:
        ```json
        "autoload": {
            "psr-4": {
                "App\\": "app/"
            }
        }
        ```
    - Here, the namespace `App\` maps to the `app/` directory, so any class in the `App` namespace will be located in the `app` folder.

3. **Why Autoload?**:
    - Reduces repetitive code by automatically resolving file locations.
    - Keeps the application organized by aligning namespaces with directory structures.
    - Enhances maintainability by removing manual file inclusions.

#### Example:

-   When you define a class in `app/Models/User.php` like:

```php
namespace App\Models;

class User {
    // Class code here
}
```

-   You can use it anywhere in your project with:

```php
use App\Models\User;

$user = new User();
```

-   No manual `require` is needed because Laravel’s autoloader resolves the namespace and file path.

# Namespace

-   In Laravel (and PHP), a **namespace** is a way to group related classes, interfaces, traits, or functions to avoid name collisions and improve code organization.

#### Why Use Namespaces?

1. **Avoid Conflicts**:
    - Multiple libraries or parts of the application might have classes with the same name (e.g., `User`). Namespaces prevent these conflicts.
2. **Organize Code**:
    - Namespaces help categorize classes logically (e.g., `App\Controllers`, `App\Models`).
3. **Simplify Imports**:
    - Instead of writing long paths repeatedly, you can use `use` statements to import and use classes.

#### Laravel’s Default Namespace:

By default, all application classes are under the `App` namespace, as defined in the `composer.json` file:

```json
"psr-4": {
    "App\\": "app/"
}
```

#### How to Use Namespaces:

1. **Declare a Namespace**:

    - At the top of your file:

        ```php
        namespace App\Models;

        class User {
            // Code
        }
        ```

2. **Access Classes with Namespaces**:

    - Use the full namespace:
        ```php
        $user = new \App\Models\User();
        ```
    - Or import it using `use`:

        ```php
        use App\Models\User;

        $user = new User();
        ```

#### Example:

```php
namespace App\Http\Controllers;

use App\Models\User;

class UserController {
    public function index() {
        return User::all();
    }
}
```

-   Here, the `UserController` class is grouped under `App\Http\Controllers`, and it imports the `User` model from `App\Models`.
