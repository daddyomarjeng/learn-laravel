# **Learn Laravel**

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

### **Installations and Documentation**

For a complete guide on installation, visit: [Laravel Official Documentation](https://laravel.com/docs/11.x/installation).

### **Creating a New Laravel Project**

To create a new Laravel project, use the following command:

```bash
laravel new project-name
```

# **Database Connection**

### **Setting Up Database Connection in `.env`**

-   You can configure your database connection in the `.env` file.

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

# Artisan in Laravel

-   Artisan is Laravel's built-in **command-line interface (CLI)** that helps developers streamline and automate repetitive tasks in the development process.
-   It provides a wide range of commands to simplify tasks like file generation, database migrations, caching, and more.

---

### **Key Features of Artisan**

1. **Task Automation**: Automatically generates files like controllers, models, and migrations.
2. **Database Management**: Executes migrations, rolls back changes, and seeds databases.
3. **Application Maintenance**: Clears caches, compiles assets, and manages configurations.
4. **Custom Commands**: Developers can create custom commands for specific project needs.

---

### **How to Use Artisan Help**

To access help for Artisan commands:

-   List all available commands:

    ```bash
    php artisan
    ```

    -   This shows a categorized list of all Artisan commands.

-   View details of a specific command:
    ```bash
    php artisan help [command]
    ```
    For example:
    ```bash
    php artisan help make:controller
    ```
    Displays usage, arguments, and options for the `make:controller` command.

---

### **Common Artisan Commands**

#### **General Commands**

-   Start a development server:

    ```bash
    php artisan serve
    ```

    -   By default, this starts a server at `http://localhost:8000`.

-   Display Laravel version:
    ```bash
    php artisan --version
    ```

#### **File Generation**

-   Create a controller:
    ```bash
    php artisan make:controller ExampleController
    ```
-   Create a model:
    ```bash
    php artisan make:model Example
    ```
-   Create a migration:
    ```bash
    php artisan make:migration create_examples_table
    ```

#### **Database Commands**

-   You can view information about your database connection by running the command:

```bash
php artisan db:show
```

-   Run migrations:
    ```bash
    php artisan migrate
    ```
-   Rollback the last migration:
    ```bash
    php artisan migrate:rollback
    ```
-   Seed the database:
    ```bash
    php artisan db:seed
    ```

#### **Maintenance Commands**

-   Clear application cache:
    ```bash
    php artisan cache:clear
    ```
-   Clear route cache:
    ```bash
    php artisan route:clear
    ```
-   Optimize the application:
    ```bash
    php artisan optimize
    ```

#### **Testing and Debugging**

-   Enter the Tinker shell to interact with your application:
    ```bash
    php artisan tinker
    ```

#### **Custom Commands**

-   You can create a custom command with:

```bash
php artisan make:command CustomCommand
```

---

### **Benefits of Artisan**

-   **Efficiency**: Reduces time spent on manual tasks.
-   **Consistency**: Ensures uniform structure and coding standards.
-   **Powerful Debugging**: Tools like Tinker allow quick testing and debugging.
-   **Extensibility**: Supports custom commands tailored to specific project requirements.

-   Artisan is an indispensable tool for Laravel development, enhancing productivity and simplifying workflow.

# Debug

-   There is a package that can make debuging easier in laravel called **laravel debug bar**, we can install it using composer
-   install uisng command:

```bash
composer require barryvdh/laravel-debugbar --dev
```

-   Note that it sometimes slows the application and laravel automatically enables it as far as the **APP_DEBUG** in the env is set to true
-   [Read More and Download from here](https://github.com/barryvdh/laravel-debugbar)

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

# Models

-   In Laravel, a **model** is a representation of a table in the database. It acts as the primary way to interact with data using the **Eloquent ORM (Object-Relational Mapping)**.

#### Eloquent ORM (Object-Relational Mapping)

-   An ORM maps an object in your database(eg table row) to an object in your code(php code)

#### Key Features of Models:

1. **Database Table Mapping**:

    - Each model corresponds to a database table.
    - By default, Laravel assumes the table name is the plural form of the model name (e.g., `User` model maps to `users` table).

2. **Querying Data**:

    - Models allow you to perform CRUD operations using Eloquent's intuitive and expressive syntax.

3. **Relationships**:

    - Models define relationships like `one-to-one`, `one-to-many`, `many-to-many`, etc.

4. **Attributes & Casting**:
    - Models handle data attributes and casting them to specific types (e.g., `datetime`, `boolean`).

#### Defining a Model:

-   You can create a model using the Artisan command:

```bash
php artisan make:model User
```

-   The `app/Models/User.php` file is generated:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $fillable = ['name', 'email', 'password'];
}
```

#### Using a Model:

1. **Retrieve Data**:

    ```php
    use App\Models\User;

    $users = User::all(); // Get all users
    $user = User::find(1); // Find user by ID
    ```

2. **Create Data**:

    ```php
    User::create([
        'name' => 'Omar Jeng',
        'email' => 'omar@example.com',
        'password' => bcrypt('password'),
    ]);
    ```

3. **Update Data**:

    ```php
    $user = User::find(1);
    $user->name = 'Updated Name';
    $user->save();
    ```

4. **Delete Data**:
    ```php
    $user = User::find(1);
    $user->delete();
    ```

#### Relationships in Models:

-   Models can define relationships with other models. For example:

```php
// In User.php
public function posts() {
    return $this->hasMany(Post::class);
}
```

#### Example:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    protected $fillable = ['title', 'content', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
```

-   With this relationship:

```php
$post = Post::find(1);
echo $post->user->name; // Access the user of the post
```

# Migrations in Laravel

-   Migrations in Laravel are a type of version control for your database. They allow you to define and manage database schemas (tables, columns, indexes, etc.) using PHP code, rather than writing raw SQL queries.

---

### **Why Use Migrations?**

1. **Version Control for Databases**:

    - Migrations let you track changes to the database schema over time.
    - Each migration is like a "commit" that documents a change, making it easier to collaborate and roll back changes when needed.

2. **Database Portability**:

    - Migrations are database-agnostic, meaning they work across different database systems (e.g., MySQL, PostgreSQL, SQLite).
    - You write PHP code, and Laravel generates the appropriate SQL for your database.

3. **Consistency Across Environments**:
    - Migrations ensure that development, staging, and production environments have the same database structure.

---

### **How to Use Migrations**

#### 1. **Creating Migrations**

-   Use the Artisan command to create a migration file:

```bash
php artisan make:migration create_users_table
```

-   This generates a file in the `database/migrations` directory with a timestamped name (e.g., `2024_11_23_000000_create_users_table.php`).

-   **Note** you can create a migration file while creating a mode by passing the **-m** flag or **--migration**

```bash
php artisan make:model Post -m
```

#### 2. **Editing the Migration File**

-   Inside the generated migration file, you define the schema for the table. For example:

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // String column
            $table->string('email')->unique(); // Unique email column
            $table->string('password');
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    public function down() {
        Schema::dropIfExists('users'); // Rolls back the migration
    }
}
```

#### 3. **Running Migrations**

-   To apply the migrations and update the database schema:

```bash
php artisan migrate
```

-   Laravel executes the `up()` method of each migration that hasn't been run yet.

#### 4. **Rolling Back Migrations**

-   To undo the last batch of migrations:

```bash
php artisan migrate:rollback
```

-   Laravel executes the `down()` method of each migration in the last batch.

-   To rollback all migrations:

```bash
php artisan migrate:reset
```

#### 5. **Refreshing Migrations**

-   To reset and re-run all migrations (useful during development):

```bash
php artisan migrate:refresh
```

-   This is equivalent to rolling back all migrations and running them again.

#### 6. **Seeding Data with Migrations**

-   Migrations can work with seeders to populate tables with dummy or default data. For example:

```bash
php artisan migrate --seed
```

---

### **Key Methods in Migrations**

-   **Schema Builder**:
    -   Laravel provides a `Schema` facade for managing tables.
-   **Common Table Column Methods**:

    ```php
    $table->string('name');         // VARCHAR
    $table->integer('age');         // INTEGER
    $table->boolean('is_active');   // BOOLEAN
    $table->timestamp('created_at');// TIMESTAMP
    $table->text('description');    // TEXT
    ```

-   **Special Column Types**:

    ```php
    $table->id();                  // Auto-increment primary key
    $table->timestamps();          // created_at and updated_at
    $table->softDeletes();         // deleted_at for soft deletes
    $table->foreignId('user_id')   // Foreign key column
         ->constrained()           // Adds foreign key constraint
         ->onDelete('cascade');    // Cascade delete
    ```

-   **Indexes**:
    ```php
    $table->unique('email');       // Unique index
    $table->index('name');         // Simple index
    $table->foreign('user_id')     // Foreign key
          ->references('id')
          ->on('users')
          ->onDelete('cascade');
    ```

---

### **Example: Creating a Table**

-   Here’s a complete example for a `posts` table:

```bash
php artisan make:migration create_posts_table
```

Migration File:

```php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration {
    public function up() {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Title of the post
            $table->text('content'); // Content of the post
            $table->foreignId('user_id') // Foreign key to users table
                  ->constrained()
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('posts');
    }
}
```

Run the migration:

```bash
php artisan migrate
```

-   This creates the `posts` table in your database with the specified schema.

---

### **Best Practices**

1. **Always Test Your Migrations**:
    - Before deploying, ensure migrations run successfully in a test environment.
2. **Use Descriptive Names**:

    - Migration names like `create_users_table` or `add_status_column_to_orders_table` make it clear what each migration does.

3. **Avoid Editing Migrations That Are Already Run**:

    - Instead, create a new migration to modify the database (e.g., adding a column).

4. **Use `down()` for Safe Rollbacks**:

    - Always define a `down()` method to reverse changes safely.

5. **Run Migrations in Deployment Pipelines**:
    - Ensure your deployment process runs `php artisan migrate` to keep the database schema updated.

-   Migrations are a core feature in Laravel that simplify database management, provide a clear history of changes, and make collaboration seamless. By using migrations, you maintain clean, consistent, and version-controlled database schemas across all environments.

# Factory in Laravel

-   In Laravel, a **factory** is a class used to define and generate fake data for testing and seeding databases.
-   Factories leverage Laravel's `Faker` library to quickly create dummy data for models, making it easier to test application features or populate the database with sample data.

---

### **Key Features of Factories**

1. **Model Association**: Factories are directly tied to Eloquent models.
2. **Faker Integration**: Use the `Faker` library to generate random but realistic data (e.g., names, emails, dates).
3. **Batch Creation**: Quickly create large amounts of data in bulk.
4. **Reusable Definitions**: Define reusable data structures for models.

---

### **Creating a Factory**

-   Factories are created using Artisan commands and stored in the `database/factories` directory.

#### **Command to Create a Factory**

```bash
php artisan make:factory ExampleFactory --model=Example
```

-   `ExampleFactory`: The name of the factory.
-   `--model=Example`: Specifies the Eloquent model associated with the factory.

-   This generates a file at `database/factories/ExampleFactory.php`.

-   You can also create a factory for a model while creating the model using the **-f** flag or the **--factory**

```bash
php artisan make:model Post -f
```

---

### **Structure of a Factory**

-   A typical factory file looks like this:

```php
<?php

namespace Database\Factories;

use App\Models\Example;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExampleFactory extends Factory
{
    protected $model = Example::class; // Associated model

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
```

#### **Explanation**

-   `protected $model`: Specifies the model this factory is tied to.
-   `definition()`: Returns an array of attributes with fake data for populating the model.

---

### **Using Factories**

-   Factories can be used to create records in two main contexts:

1. **Database Seeding**
2. **Testing**

#### **Basic Usage**

-   Create a single model instance:
    ```php
    Example::factory()->create();
    ```
-   Create multiple instances:
    ```php
    Example::factory()->count(10)->create();
    ```

#### **Custom Attributes**

-   Override default attributes when creating a model:

```php
Example::factory()->create([
    'name' => 'Custom Name',
]);
```

#### **Generating Data Without Saving**

-   Create a model instance without persisting it to the database:
    ```php
    Example::factory()->make();
    ```

---

### **Using Factories in Database Seeders**

-   Factories are often used in seeders to populate the database:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Example;

class ExampleSeeder extends Seeder
{
    public function run()
    {
        Example::factory()->count(50)->create();
    }
}
```

-   Run the seeder with:

```bash
php artisan db:seed --class=ExampleSeeder
```

---

### **Benefits of Factories**

1. **Time-Saving**: Automates the creation of realistic dummy data.
2. **Better Testing**: Provides a reliable way to test features with various data scenarios.
3. **Customizability**: Easily customize data generation for specific needs.
4. **Efficiency**: Batch generation of data reduces manual work.

-   Factories are an essential tool in Laravel for testing and seeding, making development and debugging faster and more reliable.

### **Using Tinker(php artisan tinker)**

-   We can use tinker interact with our laravel app in the commandline.
-   We can also run our factory using tinker:

```bash
# 1
php artisan tinker
# 2
 App\Models\User::factory(200)->create();
```

```php
// user factory
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

// post factory
<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title"=>fake()->text(),
            "content"=>fake()->text(500),
            "user_id" =>User::factory()
        ];
    }
}
```

# Explanation of Relationships in Laravel

-   Laravel provides various ways to define and manage relationships between tables using Eloquent ORM. These relationships represent the connections between data entities and make it easy to perform database queries involving related records.

---

### **Types of Relationships**

#### 1. **One-to-One Relationship**

-   Example: A user has one profile, and a profile belongs to one user.
-   **Models**: `User` and `Profile`.

**Defining One-to-One**

-   In the **`User` model**:

```php
public function profile()
{
    return $this->hasOne(Profile::class);
}
```

-   In the **`Profile` model**:

```php
public function user()
{
    return $this->belongsTo(User::class);
}
```

**Usage in Tinker**:

-   Get a user's profile:

    ```php
    $user = App\Models\User::find(1);
    $profile = $user->profile;
    ```

-   Get the user from a profile:
    ```php
    $profile = App\Models\Profile::find(1);
    $user = $profile->user;
    ```

---

#### 2. **One-to-Many Relationship**

-   Example: A user can have many posts, but a post belongs to one user.
-   **Models**: `User` and `Post`.

**Defining One-to-Many**

-   In the **`User` model**:

```php
public function posts()
{
    return $this->hasMany(Post::class);
}
```

-   In the **`Post` model**:

```php
public function author()
{
    return $this->belongsTo(User::class, "user_id");
}
```

**Usage in Tinker**:

-   Get all posts by a user:

    ```php
    $user = App\Models\User::find(1);
    $posts = $user->posts;
    ```

-   Get the author of a post:
    ```php
    $post = App\Models\Post::find(1);
    $author = $post->author;
    ```

---

#### 3. **Many-to-Many Relationship**

-   Example: A post can have multiple tags, and a tag can belong to multiple posts.
-   **Models**: `Post` and `Tag`.

**Defining Many-to-Many**

-   In the **`Post` model**:

```php
public function tags()
{
    return $this->belongsToMany(Tag::class);
}
```

-   In the **`Tag` model**:

```php
public function posts()
{
    return $this->belongsToMany(Post::class);
}
```

**Pivot Table**

-   The pivot table should be named `post_tag` by default and include `post_id` and `tag_id` as columns.
-   You can create it in the same migration file as the post/tag or you can create a new migration file and create it there.

```php
// Tags migration file
<?php

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->timestamps();
        });

        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Post::class)->constrained()->cascadeOnDelete(); // delets the record if either job or tag associated is deleted
            $table->foreignIdFor(Tag::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('post_tag');
    }
};
```

-   You can also create a seperate migration or model for post_tag

```bash
php artisan make:model PostTag -mf
```

-   Open the migration file and update it. Make sure to update name to match post_tag in the migration file.

```php
<?php

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Post::class)->constrained()->cascadeOnDelete(); // delets the record if either job or tag associated is deleted
                $table->foreignIdFor(Tag::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tag');
    }
};
```

-   migrate the changes

```bash
php artisan migrate
```

**Usage in Tinker**:

-   Get all tags for a post:

    ```php
    $post = App\Models\Post::find(1);
    $tags = $post->tags;
    ```

-   Get all posts for a tag:
    ```php
    $tag = App\Models\Tag::find(1);
    $posts = $tag->posts;
    ```

---

#### 4. **Has-Many-Through Relationship**

-   Example: A country has many posts through users.
-   **Models**: `Country`, `User`, and `Post`.

**Defining Has-Many-Through**

-   In the **`Country` model**:

```php
public function posts()
{
    return $this->hasManyThrough(Post::class, User::class);
}
```

**How It Works**

-   The `Country` model doesn’t have a direct relationship with the `Post` model.
-   Laravel uses the intermediate `User` model to query posts.

**Usage in Tinker**:

-   Get all posts for a country:
    ```php
    $country = App\Models\Country::find(1);
    $posts = $country->posts;
    ```

---

#### 5. **Polymorphic Relationships**

-   Example: A comment can belong to a post or a video.
-   **Models**: `Comment`, `Post`, and `Video`.

**Defining Polymorphic Relationships**

-   In the **`Comment` model**:

```php
public function commentable()
{
    return $this->morphTo();
}
```

-   In the **`Post` model**:

```php
public function comments()
{
    return $this->morphMany(Comment::class, 'commentable');
}
```

-   In the **`Video` model**:

```php
public function comments()
{
    return $this->morphMany(Comment::class, 'commentable');
}
```

**Usage in Tinker**:

-   Get all comments for a post:

    ```php
    $post = App\Models\Post::find(1);
    $comments = $post->comments;
    ```

-   Get the owner of a comment:
    ```php
    $comment = App\Models\Comment::find(1);
    $owner = $comment->commentable;
    ```

---

### **Your Specific Example: User and Post Relationship**

#### `Post` Model

```php
class Post extends Model
{
    use HasFactory;

    protected $fillable = ["title", "content"];

    public function author()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
```

#### `User` Model

```php
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
```

#### Usage Example

**Blade Template**:

1. Display all blogs with their authors:

    ```blade
    @foreach ($blogs as $blog)
        <li>
            <a href="/blogs/{{ $blog->id }}">
                <strong>{{ $blog->title }}</strong> - Written by: {{ $blog->author->name }}
            </a>
        </li>
    @endforeach
    ```

2. Display a single blog with its author:
    ```blade
    <h2>{{ $blog->title }}</h2>
    <p>{{ $blog->content }}</p>
    <span>Author: {{ $blog->author->name }}</span>
    ```

---

### **Eager Loading**

-   To optimize performance when querying related models, you can use **eager loading**:

```php
$blogs = Post::with('author')->get();
```

-   This ensures that related `User` data is loaded along with `Post` data, reducing the number of queries.

---

### **Benefits of Laravel Relationships**

1. **Simplified Querying**: Manage relationships without writing complex SQL queries.
2. **Readable Code**: Models clearly define relationships.
3. **Lazy vs. Eager Loading**: Flexibility to load related models efficiently.
4. **Consistent Logic**: Centralized and reusable relationship definitions.

# N+1 Problem, Lazy Loading, and Eager Loading in Laravel

-   Laravel Eloquent provides powerful tools for working with relationships, but understanding **N+1**, **lazy loading**, and **eager loading** is crucial to ensure your application remains efficient and scalable.

---

### **1. The N+1 Problem**

#### **What is the N+1 Problem?**

-   The **N+1 problem** occurs when querying a parent model and then iterating over its children, resulting in multiple queries being executed—one query to fetch the parent and N additional queries to fetch related children.

#### **Example of N+1 Problem**

Imagine you want to fetch all posts and display their authors.

```php
$posts = Post::all(); // Query 1: Fetch all posts

foreach ($posts as $post) {
    echo $post->author->name; // N Queries: Fetch the author for each post
}
```

-   **Query Breakdown**:

    1. One query to retrieve all posts.
    2. For each post, an additional query retrieves the author (`N` queries for `N` posts).

-   For 100 posts, this results in **101 queries**, which is inefficient.

---

### **2. Lazy Loading**

#### **What is Lazy Loading?**

-   Lazy loading is the default behavior in Laravel. When you access a related model, Eloquent fetches it on-demand (i.e., when it's first accessed).

#### **Example of Lazy Loading**

-   Using the earlier example:

```php
$posts = Post::all(); // Only fetch posts

foreach ($posts as $post) {
    echo $post->author->name; // Fetch the author only when accessed
}
```

-   **How It Works**:
    -   The `Post` records are retrieved first.
    -   When `$post->author` is accessed, Eloquent runs a separate query to fetch the author.

#### **Problem with Lazy Loading**

-   Lazy loading can cause the **N+1 problem** because related models are queried one at a time.

---

### **3. Eager Loading**

#### **What is Eager Loading?**

-   Eager loading solves the **N+1 problem** by preloading the related data in a single query. It ensures that Laravel retrieves both the parent and related models upfront.

#### **How to Use Eager Loading**

-   You can use the `with()` method to specify relationships to preload.

```php
$posts = Post::with('author')->get(); // Fetch posts with their authors in one query

foreach ($posts as $post) {
    echo $post->author->name; // No additional queries are run
}
```

-   **Query Breakdown**:
    1. One query retrieves all posts.
    2. A second query retrieves all authors for those posts.
    -   Total: **2 queries**, regardless of the number of posts.

---

### **Comparison of Lazy and Eager Loading**

| **Aspect**          | **Lazy Loading**                      | **Eager Loading**                         |
| ------------------- | ------------------------------------- | ----------------------------------------- |
| **Query Timing**    | On-demand (when accessed).            | At the time of fetching the parent model. |
| **Performance**     | Can cause N+1 queries.                | Optimized for fewer queries.              |
| **Code Simplicity** | Easy to write but may be inefficient. | Requires explicit `with()` calls.         |

---

### **4. Eager Loading with Nested Relationships**

-   Eager loading supports nested relationships, allowing you to preload related data for multiple levels.

#### **Example**

-   If a `Post` has an `Author`, and the `Author` has a `Profile`:

```php
$posts = Post::with('author.profile')->get();
// or the following for multiple
 $blogs = Post::with("author")->with("tags")->get();
```

This query fetches:

1. All posts.
2. Authors of the posts.
3. Profiles of the authors.

---

### **5. Preventing N+1 with Eager Loading**

-   Laravel's `with()` ensures related data is loaded efficiently:

```php
$posts = Post::with('author')->get();
```

-   You can even add conditions to eager loading:

```php
$posts = Post::with(['author' => function ($query) {
    $query->where('active', true);
}])->get();
```

---

### **6. Eager Loading vs. Lazy Eager Loading**

-   Laravel also provides **lazy eager loading**, which allows you to load relationships after fetching the parent models.

#### **Lazy Eager Loading Example**

```php
$posts = Post::all(); // Fetch posts
$posts->load('author'); // Load authors for the posts
```

-   This is useful when you already have the parent records and decide to load related data later.

---

### **Conclusion**

1. **Lazy Loading**: Fetches related data only when accessed but risks the **N+1 problem**.
2. **Eager Loading**: Fetches related data upfront, reducing the number of queries and improving performance.
3. **Use Eager Loading** (`with()`) whenever possible to avoid the **N+1 problem**.
4. **Nested and Conditional Loading**: Allows loading complex relationships or applying filters to the related data.

-   By managing loading strategies effectively, you can ensure your Laravel application is both performant and readable.

### **Preventing Lazy Loading in Laravel**

-   Lazy loading can lead to the **N+1 problem**, which negatively impacts performance. To avoid this, Laravel provides a way to **prevent lazy loading** and ensure all relationships are explicitly loaded upfront.

---

### **How to Prevent Lazy Loading**

#### **1. Use `preventLazyLoading()` in Development**

-   Laravel offers a method to disable lazy loading during development. This makes it easier to identify and fix potential performance issues by throwing an exception whenever lazy loading occurs.

-   Add the following to your `AppServiceProvider`'s `boot()` method:

```php
use Illuminate\Database\Eloquent\Model;

public function boot()
{
    Model::preventLazyLoading();
}
```

-   **Effect**: If you access a relationship that wasn’t explicitly loaded using `with()`, Laravel will throw an exception.

---

#### **2. Allow Lazy Loading in Production**

-   Since exceptions could break the application, you can conditionally enable lazy loading only in non-production environments:

```php
if (!app()->isProduction()) {
    Model::preventLazyLoading();
}
```

---

#### **3. Fix Lazy Loading Issues**

-   When exceptions occur due to lazy loading, update your queries to explicitly use **eager loading** with the `with()` method:

```php
$posts = Post::with('author')->get();
```

---

### **Benefits of Preventing Lazy Loading**

1. **Performance Optimization**: Prevents N+1 queries by encouraging proper relationship loading.
2. **Improved Code Quality**: Forces developers to be explicit about relationships, making the code more predictable and easier to debug.
3. **Proactive Error Detection**: Identifies lazy loading issues during development, ensuring they don’t go unnoticed.

---

-   By enabling `preventLazyLoading()`, you can enforce better practices and optimize your Laravel application's performance.

# Pagination in Laravel: A Comprehensive Guide

-   Pagination in Laravel provides a simple and elegant way to handle large datasets by splitting them into smaller, more manageable chunks. Laravel’s paginator is highly customizable, with support for different CSS frameworks and the ability to define custom views.

---

### **Basic Pagination**

-   Laravel provides two main methods for pagination:

1. **`paginate`**:

    - Retrieves a specified number of records per page.
    - Returns an instance of `LengthAwarePaginator`.

    ```php
    $blogs = Post::paginate(10);
    return view('blogs', ['blogs' => $blogs]);
    ```

2. **`simplePaginate`**:

    - Optimized for performance but lacks page numbers.
    - Returns an instance of `Paginator`.

    ```php
    $blogs = Post::simplePaginate(10);
    return view('blogs', ['blogs' => $blogs]);
    ```

3. **`cursorPaginate`**:

    - Optimized for performance and lacks page numbers just like the simplePaginate but **it is the most performant option** especially if you are dealing with a large dataset.
    - It has a downside though, the url for next page is some randomly generated string and user cannot manually change the page from the url.
    - Returns an instance of `Paginator`.

    ```php
    $blogs = Post::with("author")->with("tags")->cursorPaginate(10);
    return view('blogs', ['blogs' => $blogs]);
    ```

-   In your Blade file, use the `links()` method to render the pagination links:

```php
<ul>
    @foreach ($blogs as $blog)
        <li>
            <a href="/blogs/{{ $blog->id }}">{{ $blog->title }}</a>
        </li>
    @endforeach
</ul>

{{ $blogs->links() }}
```

---

### **Customizing Pagination UI**

#### **1. Using the Default Tailwind CSS View**

-   Laravel assumes **Tailwind CSS** is the default CSS framework for pagination. The `links()` method generates Tailwind-styled pagination out of the box.

Example:

```php
{{ $blogs->links() }}
```

This uses the `resources/views/vendor/pagination/tailwind.blade.php` view.

#### **2. Switching to Bootstrap or Custom CSS Frameworks**

-   If you are using **Bootstrap** or another framework, you can change the pagination view globally or locally.

##### **Global Customization in \*\***`AppServiceProvider`\*\*

-   To switch globally to Bootstrap:

1. Open `App\Providers\AppServiceProvider.php`.
2. Add the following in the `boot` method:

    ```php
    use Illuminate\Pagination\Paginator;

    public function boot()
    {
        Paginator::useBootstrap();
    }
    ```

To switch to a custom view:

```php
Paginator::defaultView('custom-pagination-view');
```

##### **Local Customization for Specific Paginations**

-   You can specify a custom view directly in the Blade file:

```php
{{ $blogs->links('vendor.pagination.bootstrap') }} <!-- Use Bootstrap view -->
{{ $blogs->links('custom-pagination-view') }} <!-- Use a custom view -->
```

---

### **Publishing Pagination Views for Customization**

To modify the default pagination views:

1. Run the following Artisan command:

    ```bash
    php artisan vendor:publish --tag=laravel-pagination
    ```

2. This copies the pagination views to `resources/views/vendor/pagination/`.

3. You can edit these views (e.g., `bootstrap.blade.php` or `tailwind.blade.php`) to suit your application.

---

### **Examples with \*\***`blogs.blade.php`\*\*

-   Here’s how you can implement pagination in a Blade file:

```php
<x-layout>
    <x-slot:heading>
        Blogs Page
    </x-slot:heading>

    <ul>
        @foreach ($blogs as $blog)
            <li class="leading-2">
                <a href="/blogs/{{ $blog->id }}">
                    <strong>{{ $blog->title }}</strong> - Written by: {{ $blog->author->name }}
                </a>
            </li>
        @endforeach
    </ul>

    <!-- Default Tailwind pagination -->
    {{ $blogs->links() }}

    <!-- Custom Bootstrap pagination -->
    {{ $blogs->links('vendor.pagination.bootstrap') }}
</x-layout>
```

---

### **Switching Back to Tailwind Pagination**

-   If you want to revert to Tailwind CSS, use:

```php
Paginator::useTailwind();
```

-   This is Laravel’s default pagination style.

---

### **Conclusion**

-   Laravel’s pagination system is highly flexible, supporting Tailwind CSS by default while allowing seamless integration with other frameworks like Bootstrap or custom views. Additionally, using eager loading in pagination ensures optimal performance by avoiding the N+1 problem. Customize your pagination views to match your application’s design and provide a polished user experience.
