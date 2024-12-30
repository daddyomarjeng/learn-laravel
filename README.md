# **Learn Laravel**

> # PHP & LARAVEL TIPS

- **dd function =>** means dump and die, dumps the data in the browser and then kills the execution.

```php
dd("DOJ")
```

- **Laravel ARR class=>** is a laravel helper class that takes in an array and has a lot of other helper methods to help work with arrays. Eg.:

```php
   $post =  Arr::first($blogs, function($blog) {
        return $blog['id'] == 1;
    });
```

- **Accessing outside data/variables in a closure=>** example if we want to access a variable in a function but the variable is declared outside the function. We have two ways to access it:
  - **1. The 'use' function=>** eg use($id)
  ```php
    $post =  Arr::first($blogs, function($blog) use($id) {
      return $blog['id'] == $id;
  });
  ```
  - **2. The 'fn' or 'arrow function'**
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

- You can configure your database connection in the `.env` file.

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

- Artisan is Laravel's built-in **command-line interface (CLI)** that helps developers streamline and automate repetitive tasks in the development process.
- It provides a wide range of commands to simplify tasks like file generation, database migrations, caching, and more.

---

### **Key Features of Artisan**

1. **Task Automation**: Automatically generates files like controllers, models, and migrations.
2. **Database Management**: Executes migrations, rolls back changes, and seeds databases.
3. **Application Maintenance**: Clears caches, compiles assets, and manages configurations.
4. **Custom Commands**: Developers can create custom commands for specific project needs.

---

### **How to Use Artisan Help**

To access help for Artisan commands:

- List all available commands:

  ```bash
  php artisan
  ```

  - This shows a categorized list of all Artisan commands.

- View details of a specific command:
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

- Start a development server:

  ```bash
  php artisan serve
  ```

  - By default, this starts a server at `http://localhost:8000`.

- Display Laravel version:
  ```bash
  php artisan --version
  ```

#### **File Generation**

- Create a controller:
  ```bash
  php artisan make:controller ExampleController
  ```
- Create a model:
  ```bash
  php artisan make:model Example
  ```
- Create a migration:
  ```bash
  php artisan make:migration create_examples_table
  ```

#### **Database Commands**

- You can view information about your database connection by running the command:

```bash
php artisan db:show
```

- Run migrations:
  ```bash
  php artisan migrate
  ```
- Rollback the last migration:
  ```bash
  php artisan migrate:rollback
  ```
- Seed the database:
  ```bash
  php artisan db:seed
  ```

#### **Maintenance Commands**

- Clear application cache:
  ```bash
  php artisan cache:clear
  ```
- Clear route cache:
  ```bash
  php artisan route:clear
  ```
- Optimize the application:
  ```bash
  php artisan optimize
  ```

#### **Testing and Debugging**

- Enter the Tinker shell to interact with your application:
  ```bash
  php artisan tinker
  ```

#### **Custom Commands**

- You can create a custom command with:

```bash
php artisan make:command CustomCommand
```

---

### **Benefits of Artisan**

- **Efficiency**: Reduces time spent on manual tasks.
- **Consistency**: Ensures uniform structure and coding standards.
- **Powerful Debugging**: Tools like Tinker allow quick testing and debugging.
- **Extensibility**: Supports custom commands tailored to specific project requirements.

- Artisan is an indispensable tool for Laravel development, enhancing productivity and simplifying workflow.

# Debug

- There is a package that can make debuging easier in laravel called **laravel debug bar**, we can install it using composer
- install uisng command:

```bash
composer require barryvdh/laravel-debugbar --dev
```

- Note that it sometimes slows the application and laravel automatically enables it as far as the **APP_DEBUG** in the env is set to true
- [Read More and Download from here](https://github.com/barryvdh/laravel-debugbar)

# Autoload

- In Laravel, **autoload** refers to the mechanism that allows PHP classes, interfaces, or traits to be loaded automatically when they are needed, without requiring manual `include` or `require` statements.

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

- When you define a class in `app/Models/User.php` like:

```php
namespace App\Models;

class User {
    // Class code here
}
```

- You can use it anywhere in your project with:

```php
use App\Models\User;

$user = new User();
```

- No manual `require` is needed because Laravel’s autoloader resolves the namespace and file path.

# Namespace

- In Laravel (and PHP), a **namespace** is a way to group related classes, interfaces, traits, or functions to avoid name collisions and improve code organization.

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

- Here, the `UserController` class is grouped under `App\Http\Controllers`, and it imports the `User` model from `App\Models`.

# Routes

- Laravel routes define the paths that users can access in your application. They support web, API, and console routes.
- You can list all routes using the command:

```bash
php artisan route:list
```

- The above shows all routes including ones created by laravel, but if you only want to see the ones you have created you can run the following:

```bash
php artisan route:list --except-vendor
```

### **Web Routes**

- Web routes typically return views using the `view()` method. All views are stored in the `resources/views` directory.

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

- To enable API routing in your application, you can use the following command:

```bash
php artisan install:api
```

### **Route Wildcards (Dynamic Routes)**

- Dynamic routes allow you to capture parameters directly from the URL by using placeholders in curly braces `{}`.

#### **Example: Single Wildcard**

```php
Route::get('/user/{id}', function ($id) {
    return "User ID: " . $id;
});
```

- In this example, `{id}` is a placeholder that captures the dynamic value from the URL.
- Accessing `/user/123` will return "User ID: 123".

#### **Example: Multiple Wildcards**

```php
Route::get('/post/{postId}/comment/{commentId}', function ($postId, $commentId) {
    return "Post ID: $postId, Comment ID: $commentId";
});
```

#### **Optional Wildcards**

- Add a `?` to make a parameter optional, and provide a default value:

```php
Route::get('/user/{name?}', function ($name = 'Guest') {
    return "Hello, " . $name;
});
```

#### **Route Constraints**

- You can restrict the values captured by a wildcard using the `where` method:

```php
Route::get('/user/{id}', function ($id) {
    return "User ID: " . $id;
})->where('id', '[0-9]+'); // Only numeric IDs are allowed
```

# Components

- Laravel components are reusable blocks, such as menus, buttons, or layouts, that can be used throughout your application.

### **Directory**

- All components should be stored in the `resources/views/components` directory. Ensure the folder name is spelled as `components`.

### **Using Components**

- To use a component, prefix its name with `x-` in your Blade files. For example:
- Their is a global variable available in component files called **slot** that we can use to display anything that is wrapped withing the componet
  - You can use the php echo to display it or you can use blade template helper, which enables you to call variables by wrapping them between four curly brackets.
  - Under the hood, blade transforms the content within the brackets as echo whatever is inside the brackets.
- To use a component in another file you will have to prefix the name of the component with **x-** to tell laravel that it is a component and for it to look for the file in the component folder
- Example Layout File:

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

- Exaple using the component

```php
<x-layout>
    <h1>Home Page</h1>
</x-layout>
```

# Attributes, Props, & Conditional Classes(Styling)

- **Attributes=>** All Lavarevl Components also have access to an **attributes object(HTML Attributes)**, example: _href, class, id, etc._ - You can access it by using the whole attributes passed or by getting only specific attribute:

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

- **Props=>** By default all values added to the component will be considered as attributes,
- When we accept a prop into a component, the first thing we need to do is to declare the prop we are accepting at the top of the file by using a **blade directive called _@props_** and pass in it an array of props we want to accept and any default value we want to give to those props.
- All props and attributes as considered as string values by default. If we want to assign variables or other values to them we can just add a column before the prop name which allows us to bind some dynamic value or data to the prop as it's value.
- if we do not declare the prop at the top of the file, blade will assume that the prop is an attribute and will treat it like that.

- **Conditional Classes=>** We can use conditional css classes in blade by using the blade directive: **@class**

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

- Slots can be considered as different areas where we paste in content
- Like we learn earlier, we can use the variable **slot** to access anything wrapped within a component.
- **Types of Slots=>** We have default slot and named slots.
  - **Default Slot=>** This variable holds content of anything that is wrapped within the component
  - **Named Slots=>** These are multiple slots that are identift by using names and can be accessed as variables in the component. We can pass a slot by preceeding it with: **x-slot:** and then followed by the slot name or variable.

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

- We can use the globally available request object in laravel to get access to the current path(url) of our app
- We can use that to style or perform actions in our app

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

- We can conditionally render elements using conditionals.
- We can either use the traditional php method or use blade helper directives to achieve it.

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

- We can pass a second arguement to the view functions, which will be an array where each of the keys will be extracted into variables once the view or template is loaded

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

- `{id}` is a wildcard that captures the value from the URL.
- When accessing `/user/123`, the `$id` parameter will hold the value `123`.

- A moore real world example is:

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

# Route Views in Laravel

- Route views in Laravel provide a simple way to return a static view directly from your routes without creating a controller. This approach is ideal for routes that only need to display a view without complex logic or data processing.

---

### **Defining a Route View**

- You can define a route that returns a view using the `Route::view` method. Here's an example:

```php
Route::view('/welcome', 'welcome');
```

- In this example:

  - `/welcome` is the URL path.
  - `'welcome'` is the name of the Blade view (stored in the `resources/views` directory as `welcome.blade.php`).

- When a user visits `/welcome`, Laravel directly renders the `welcome.blade.php` file.

---

### **Passing Data to Views**

- You can also pass data to the view using the `Route::view` method by providing an associative array as the third argument:

```php
Route::view('/about', 'about', ['name' => 'Omar', 'role' => 'Engineer']);
```

- In this example:
  - The `about` view will have access to `name` and `role` as variables.

**`about.blade.php` Example**:

```blade
<h1>About Page</h1>
<p>Name: {{ $name }}</p>
<p>Role: {{ $role }}</p>
```

---

### **When to Use Route Views**

1. **Static Pages**: For pages like "About Us", "Contact", or "FAQ" that don’t require dynamic content.
2. **Prototyping**: Quickly create a route for a view during initial development.
3. **Minimal Logic**: If no controller logic or model interaction is required.

---

### **Benefits of Route Views**

1. **Simplicity**: Reduces boilerplate by avoiding unnecessary controller creation.
2. **Clarity**: Keeps routes concise for simple pages.
3. **Quick Setup**: Perfect for prototyping or static content.

---

### **Limitations of Route Views**

1. **No Logic Handling**: They can’t process complex logic or interact with models.
2. **Limited Reusability**: For non-static or dynamic pages, controllers are more appropriate.

---

### **Best Practice**

- While `Route::view` is useful for simple pages, as your application grows, it's better to use controllers to handle business logic and ensure scalability.

# Models

- In Laravel, a **model** is a representation of a table in the database. It acts as the primary way to interact with data using the **Eloquent ORM (Object-Relational Mapping)**.

#### Eloquent ORM (Object-Relational Mapping)

- An ORM maps an object in your database(eg table row) to an object in your code(php code)

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

- You can create a model using the Artisan command:

```bash
php artisan make:model User
```

- The `app/Models/User.php` file is generated:

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

- Models can define relationships with other models. For example:

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

- With this relationship:

```php
$post = Post::find(1);
echo $post->user->name; // Access the user of the post
```

# Migrations in Laravel

- Migrations in Laravel are a type of version control for your database. They allow you to define and manage database schemas (tables, columns, indexes, etc.) using PHP code, rather than writing raw SQL queries.

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

- Use the Artisan command to create a migration file:

```bash
php artisan make:migration create_users_table
```

- This generates a file in the `database/migrations` directory with a timestamped name (e.g., `2024_11_23_000000_create_users_table.php`).

- **Note** you can create a migration file while creating a mode by passing the **-m** flag or **--migration**

```bash
php artisan make:model Post -m
```

#### 2. **Editing the Migration File**

- Inside the generated migration file, you define the schema for the table. For example:

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

- To apply the migrations and update the database schema:

```bash
php artisan migrate
```

- Laravel executes the `up()` method of each migration that hasn't been run yet.

#### 4. **Rolling Back Migrations**

- To undo the last batch of migrations:

```bash
php artisan migrate:rollback
```

- Laravel executes the `down()` method of each migration in the last batch.

- To rollback all migrations:

```bash
php artisan migrate:reset
```

#### 5. **Refreshing Migrations**

- To reset and re-run all migrations (useful during development):

```bash
php artisan migrate:refresh
```

- This is equivalent to rolling back all migrations and running them again.

#### 6. **Seeding Data with Migrations**

- Migrations can work with seeders to populate tables with dummy or default data. For example:

```bash
php artisan migrate --seed
```

---

### **Key Methods in Migrations**

- **Schema Builder**:
  - Laravel provides a `Schema` facade for managing tables.
- **Common Table Column Methods**:

  ```php
  $table->string('name');         // VARCHAR
  $table->integer('age');         // INTEGER
  $table->boolean('is_active');   // BOOLEAN
  $table->timestamp('created_at');// TIMESTAMP
  $table->text('description');    // TEXT
  ```

- **Special Column Types**:

  ```php
  $table->id();                  // Auto-increment primary key
  $table->timestamps();          // created_at and updated_at
  $table->softDeletes();         // deleted_at for soft deletes
  $table->foreignId('user_id')   // Foreign key column
       ->constrained()           // Adds foreign key constraint
       ->onDelete('cascade');    // Cascade delete
  ```

- **Indexes**:
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

- Here’s a complete example for a `posts` table:

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

- This creates the `posts` table in your database with the specified schema.

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

- Migrations are a core feature in Laravel that simplify database management, provide a clear history of changes, and make collaboration seamless. By using migrations, you maintain clean, consistent, and version-controlled database schemas across all environments.

# Factory in Laravel

- In Laravel, a **factory** is a class used to define and generate fake data for testing and seeding databases.
- Factories leverage Laravel's `Faker` library to quickly create dummy data for models, making it easier to test application features or populate the database with sample data.

---

### **Key Features of Factories**

1. **Model Association**: Factories are directly tied to Eloquent models.
2. **Faker Integration**: Use the `Faker` library to generate random but realistic data (e.g., names, emails, dates).
3. **Batch Creation**: Quickly create large amounts of data in bulk.
4. **Reusable Definitions**: Define reusable data structures for models.

---

### **Creating a Factory**

- Factories are created using Artisan commands and stored in the `database/factories` directory.

#### **Command to Create a Factory**

```bash
php artisan make:factory ExampleFactory --model=Example
```

- `ExampleFactory`: The name of the factory.
- `--model=Example`: Specifies the Eloquent model associated with the factory.

- This generates a file at `database/factories/ExampleFactory.php`.

- You can also create a factory for a model while creating the model using the **-f** flag or the **--factory**

```bash
php artisan make:model Post -f
```

---

### **Structure of a Factory**

- A typical factory file looks like this:

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

- `protected $model`: Specifies the model this factory is tied to.
- `definition()`: Returns an array of attributes with fake data for populating the model.

---

### **Using Factories**

- Factories can be used to create records in two main contexts:

1. **Database Seeding**
2. **Testing**

#### **Basic Usage**

- Create a single model instance:
  ```php
  Example::factory()->create();
  ```
- Create multiple instances:
  ```php
  Example::factory()->count(10)->create();
  ```

#### **Custom Attributes**

- Override default attributes when creating a model:

```php
Example::factory()->create([
    'name' => 'Custom Name',
]);
```

#### **Generating Data Without Saving**

- Create a model instance without persisting it to the database:
  ```php
  Example::factory()->make();
  ```

---

### **Using Factories in Database Seeders**

- Factories are often used in seeders to populate the database:

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

- Run the seeder with:

```bash
php artisan db:seed --class=ExampleSeeder
```

---

### **Benefits of Factories**

1. **Time-Saving**: Automates the creation of realistic dummy data.
2. **Better Testing**: Provides a reliable way to test features with various data scenarios.
3. **Customizability**: Easily customize data generation for specific needs.
4. **Efficiency**: Batch generation of data reduces manual work.

- Factories are an essential tool in Laravel for testing and seeding, making development and debugging faster and more reliable.

### **Using Tinker(php artisan tinker)**

- We can use tinker interact with our laravel app in the commandline.
- We can also run our factory using tinker:

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

# Database Seeders in Laravel

- Database seeders in Laravel are used to populate your database with sample or initial data. Seeders are especially useful during development to quickly insert test data into your database or to set up the initial state for your application.

---

### **Creating a Seeder**

- You can create a seeder using the `make:seeder` Artisan command:

```bash
php artisan make:seeder NameOfSeeder
```

- This command generates a new seeder file in the `database/seeders` directory.

#### **Example: Creating a `UserSeeder`**

```bash
php artisan make:seeder UserSeeder
```

- This creates the file `database/seeders/UserSeeder.php`.

---

### **Writing Seeder Logic**

- Open the seeder file and define the data insertion logic in the `run` method.

#### **Example: Populating the Users Table**

```php
<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Using factories to generate test data
        User::factory(10)->create(); // Creates 10 users
    }
}
```

- You can also insert data manually:

```php
User::create([
    'name' => 'John Doe',
    'email' => 'johndoe@example.com',
    'password' => bcrypt('password123'),
]);
```

---

### **Running Seeders**

- To execute a seeder, use the `db:seed` Artisan command:

```bash
php artisan db:seed --class=UserSeeder
```

- To run all seeders defined in `DatabaseSeeder`:

```bash
php artisan db:seed
```

---

### **The `DatabaseSeeder` File**

- The `DatabaseSeeder` file is the main entry point for running multiple seeders. By default, it is located at `database/seeders/DatabaseSeeder.php`.

- You can call multiple seeders from here:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PostSeeder::class,
        ]);
    }
}
```

---

### **Using Factories with Seeders**

- Seeders often use **factories** to generate realistic dummy data. Factories allow you to define how your model's test data should look.

#### **Example: Using a Factory in a Seeder**

- Assuming a `PostFactory` is defined:

```php
Post::factory(50)->create(); // Creates 50 posts
```

---

### **Resetting and Reseeding the Database**

- If you want to reset the database and reseed it, you can use:

```bash
php artisan migrate:refresh --seed
```

- This command:
  1. Rolls back all migrations.
  2. Re-runs the migrations.
  3. Runs the seeders to repopulate the database.

---

### **Customizing Seeder Logic**

- You can customize the logic in seeders to associate data or conditionally seed.

#### **Example: Assigning Posts to Users**

```php
public function run(): void
{
    $users = User::factory(10)->create();

    $users->each(function ($user) {
        Post::factory(5)->create(['user_id' => $user->id]); // 5 posts per user
    });
}
```

---

### **Testing with Seeders in Tinker**

- You can use `tinker` to test your seeders:

```bash
php artisan tinker
>>> Artisan::call('db:seed', ['--class' => 'UserSeeder']);
```

---

### **Summary of Commands**

1. **Create a Seeder:**
   ```bash
   php artisan make:seeder NameOfSeeder
   ```
2. **Run a Specific Seeder:**
   ```bash
   php artisan db:seed --class=NameOfSeeder
   ```
3. **Run All Seeders:**
   ```bash
   php artisan db:seed
   ```
4. **Reset and Reseed:**
   ```bash
   php artisan migrate:refresh --seed
   ```

---

### **Best Practices for Seeders**

- Use factories for realistic data generation.
- Avoid hardcoding sensitive data (e.g., passwords) in seeders.
- Keep seeders modular by creating separate files for different models.
- Use `DatabaseSeeder` to orchestrate multiple seeders.

> By combining seeders with migrations and factories, Laravel provides a seamless way to set up and populate your database.

# Explanation of Relationships in Laravel

- Laravel provides various ways to define and manage relationships between tables using Eloquent ORM. These relationships represent the connections between data entities and make it easy to perform database queries involving related records.

---

### **Types of Relationships**

#### 1. **One-to-One Relationship**

- Example: A user has one profile, and a profile belongs to one user.
- **Models**: `User` and `Profile`.

**Defining One-to-One**

- In the **`User` model**:

```php
public function profile()
{
    return $this->hasOne(Profile::class);
}
```

- In the **`Profile` model**:

```php
public function user()
{
    return $this->belongsTo(User::class);
}
```

**Usage in Tinker**:

- Get a user's profile:

  ```php
  $user = App\Models\User::find(1);
  $profile = $user->profile;
  ```

- Get the user from a profile:
  ```php
  $profile = App\Models\Profile::find(1);
  $user = $profile->user;
  ```

---

#### 2. **One-to-Many Relationship**

- Example: A user can have many posts, but a post belongs to one user.
- **Models**: `User` and `Post`.

**Defining One-to-Many**

- In the **`User` model**:

```php
public function posts()
{
    return $this->hasMany(Post::class);
}
```

- In the **`Post` model**:

```php
public function author()
{
    return $this->belongsTo(User::class, "user_id");
}
```

**Usage in Tinker**:

- Get all posts by a user:

  ```php
  $user = App\Models\User::find(1);
  $posts = $user->posts;
  ```

- Get the author of a post:
  ```php
  $post = App\Models\Post::find(1);
  $author = $post->author;
  ```

---

#### 3. **Many-to-Many Relationship**

- Example: A post can have multiple tags, and a tag can belong to multiple posts.
- **Models**: `Post` and `Tag`.

**Defining Many-to-Many**

- In the **`Post` model**:

```php
public function tags()
{
    return $this->belongsToMany(Tag::class);
}
```

- In the **`Tag` model**:

```php
public function posts()
{
    return $this->belongsToMany(Post::class);
}
```

**Pivot Table**

- The pivot table should be named `post_tag` by default and include `post_id` and `tag_id` as columns.
- You can create it in the same migration file as the post/tag or you can create a new migration file and create it there.

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

- You can also create a seperate migration or model for post_tag

```bash
php artisan make:model PostTag -mf
```

- Open the migration file and update it. Make sure to update name to match post_tag in the migration file.

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

- migrate the changes

```bash
php artisan migrate
```

**Usage in Tinker**:

- Get all tags for a post:

  ```php
  $post = App\Models\Post::find(1);
  $tags = $post->tags;
  ```

- Get all posts for a tag:
  ```php
  $tag = App\Models\Tag::find(1);
  $posts = $tag->posts;
  ```

---

#### 4. **Has-Many-Through Relationship**

- Example: A country has many posts through users.
- **Models**: `Country`, `User`, and `Post`.

**Defining Has-Many-Through**

- In the **`Country` model**:

```php
public function posts()
{
    return $this->hasManyThrough(Post::class, User::class);
}
```

**How It Works**

- The `Country` model doesn’t have a direct relationship with the `Post` model.
- Laravel uses the intermediate `User` model to query posts.

**Usage in Tinker**:

- Get all posts for a country:
  ```php
  $country = App\Models\Country::find(1);
  $posts = $country->posts;
  ```

---

#### 5. **Polymorphic Relationships**

- Example: A comment can belong to a post or a video.
- **Models**: `Comment`, `Post`, and `Video`.

**Defining Polymorphic Relationships**

- In the **`Comment` model**:

```php
public function commentable()
{
    return $this->morphTo();
}
```

- In the **`Post` model**:

```php
public function comments()
{
    return $this->morphMany(Comment::class, 'commentable');
}
```

- In the **`Video` model**:

```php
public function comments()
{
    return $this->morphMany(Comment::class, 'commentable');
}
```

**Usage in Tinker**:

- Get all comments for a post:

  ```php
  $post = App\Models\Post::find(1);
  $comments = $post->comments;
  ```

- Get the owner of a comment:
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

- To optimize performance when querying related models, you can use **eager loading**:

```php
$blogs = Post::with('author')->get();
```

- This ensures that related `User` data is loaded along with `Post` data, reducing the number of queries.

---

### **Benefits of Laravel Relationships**

1. **Simplified Querying**: Manage relationships without writing complex SQL queries.
2. **Readable Code**: Models clearly define relationships.
3. **Lazy vs. Eager Loading**: Flexibility to load related models efficiently.
4. **Consistent Logic**: Centralized and reusable relationship definitions.

# N+1 Problem, Lazy Loading, and Eager Loading in Laravel

- Laravel Eloquent provides powerful tools for working with relationships, but understanding **N+1**, **lazy loading**, and **eager loading** is crucial to ensure your application remains efficient and scalable.

---

### **1. The N+1 Problem**

#### **What is the N+1 Problem?**

- The **N+1 problem** occurs when querying a parent model and then iterating over its children, resulting in multiple queries being executed—one query to fetch the parent and N additional queries to fetch related children.

#### **Example of N+1 Problem**

Imagine you want to fetch all posts and display their authors.

```php
$posts = Post::all(); // Query 1: Fetch all posts

foreach ($posts as $post) {
    echo $post->author->name; // N Queries: Fetch the author for each post
}
```

- **Query Breakdown**:

  1. One query to retrieve all posts.
  2. For each post, an additional query retrieves the author (`N` queries for `N` posts).

- For 100 posts, this results in **101 queries**, which is inefficient.

---

### **2. Lazy Loading**

#### **What is Lazy Loading?**

- Lazy loading is the default behavior in Laravel. When you access a related model, Eloquent fetches it on-demand (i.e., when it's first accessed).

#### **Example of Lazy Loading**

- Using the earlier example:

```php
$posts = Post::all(); // Only fetch posts

foreach ($posts as $post) {
    echo $post->author->name; // Fetch the author only when accessed
}
```

- **How It Works**:
  - The `Post` records are retrieved first.
  - When `$post->author` is accessed, Eloquent runs a separate query to fetch the author.

#### **Problem with Lazy Loading**

- Lazy loading can cause the **N+1 problem** because related models are queried one at a time.

---

### **3. Eager Loading**

#### **What is Eager Loading?**

- Eager loading solves the **N+1 problem** by preloading the related data in a single query. It ensures that Laravel retrieves both the parent and related models upfront.

#### **How to Use Eager Loading**

- You can use the `with()` method to specify relationships to preload.

```php
$posts = Post::with('author')->get(); // Fetch posts with their authors in one query

foreach ($posts as $post) {
    echo $post->author->name; // No additional queries are run
}
```

- **Query Breakdown**:
  1. One query retrieves all posts.
  2. A second query retrieves all authors for those posts.
  - Total: **2 queries**, regardless of the number of posts.

---

### **Comparison of Lazy and Eager Loading**

| **Aspect**          | **Lazy Loading**                      | **Eager Loading**                         |
| ------------------- | ------------------------------------- | ----------------------------------------- |
| **Query Timing**    | On-demand (when accessed).            | At the time of fetching the parent model. |
| **Performance**     | Can cause N+1 queries.                | Optimized for fewer queries.              |
| **Code Simplicity** | Easy to write but may be inefficient. | Requires explicit `with()` calls.         |

---

### **4. Eager Loading with Nested Relationships**

- Eager loading supports nested relationships, allowing you to preload related data for multiple levels.

#### **Example**

- If a `Post` has an `Author`, and the `Author` has a `Profile`:

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

- Laravel's `with()` ensures related data is loaded efficiently:

```php
$posts = Post::with('author')->get();
```

- You can even add conditions to eager loading:

```php
$posts = Post::with(['author' => function ($query) {
    $query->where('active', true);
}])->get();
```

---

### **6. Eager Loading vs. Lazy Eager Loading**

- Laravel also provides **lazy eager loading**, which allows you to load relationships after fetching the parent models.

#### **Lazy Eager Loading Example**

```php
$posts = Post::all(); // Fetch posts
$posts->load('author'); // Load authors for the posts
```

- This is useful when you already have the parent records and decide to load related data later.

---

### **Conclusion**

1. **Lazy Loading**: Fetches related data only when accessed but risks the **N+1 problem**.
2. **Eager Loading**: Fetches related data upfront, reducing the number of queries and improving performance.
3. **Use Eager Loading** (`with()`) whenever possible to avoid the **N+1 problem**.
4. **Nested and Conditional Loading**: Allows loading complex relationships or applying filters to the related data.

- By managing loading strategies effectively, you can ensure your Laravel application is both performant and readable.

### **Preventing Lazy Loading in Laravel**

- Lazy loading can lead to the **N+1 problem**, which negatively impacts performance. To avoid this, Laravel provides a way to **prevent lazy loading** and ensure all relationships are explicitly loaded upfront.

---

### **How to Prevent Lazy Loading**

#### **1. Use `preventLazyLoading()` in Development**

- Laravel offers a method to disable lazy loading during development. This makes it easier to identify and fix potential performance issues by throwing an exception whenever lazy loading occurs.

- Add the following to your `AppServiceProvider`'s `boot()` method:

```php
use Illuminate\Database\Eloquent\Model;

public function boot()
{
    Model::preventLazyLoading();
}
```

- **Effect**: If you access a relationship that wasn’t explicitly loaded using `with()`, Laravel will throw an exception.

---

#### **2. Allow Lazy Loading in Production**

- Since exceptions could break the application, you can conditionally enable lazy loading only in non-production environments:

```php
if (!app()->isProduction()) {
    Model::preventLazyLoading();
}
```

---

#### **3. Fix Lazy Loading Issues**

- When exceptions occur due to lazy loading, update your queries to explicitly use **eager loading** with the `with()` method:

```php
$posts = Post::with('author')->get();
```

---

### **Benefits of Preventing Lazy Loading**

1. **Performance Optimization**: Prevents N+1 queries by encouraging proper relationship loading.
2. **Improved Code Quality**: Forces developers to be explicit about relationships, making the code more predictable and easier to debug.
3. **Proactive Error Detection**: Identifies lazy loading issues during development, ensuring they don’t go unnoticed.

---

- By enabling `preventLazyLoading()`, you can enforce better practices and optimize your Laravel application's performance.

# Pagination in Laravel: A Comprehensive Guide

- Pagination in Laravel provides a simple and elegant way to handle large datasets by splitting them into smaller, more manageable chunks. Laravel’s paginator is highly customizable, with support for different CSS frameworks and the ability to define custom views.

---

### **Basic Pagination**

- Laravel provides two main methods for pagination:

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

- In your Blade file, use the `links()` method to render the pagination links:

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

- Laravel assumes **Tailwind CSS** is the default CSS framework for pagination. The `links()` method generates Tailwind-styled pagination out of the box.

Example:

```php
{{ $blogs->links() }}
```

This uses the `resources/views/vendor/pagination/tailwind.blade.php` view.

#### **2. Switching to Bootstrap or Custom CSS Frameworks**

- If you are using **Bootstrap** or another framework, you can change the pagination view globally or locally.

##### **Global Customization in \*\***`AppServiceProvider`\*\*

- To switch globally to Bootstrap:

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

- You can specify a custom view directly in the Blade file:

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

- Here’s how you can implement pagination in a Blade file:

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

- If you want to revert to Tailwind CSS, use:

```php
Paginator::useTailwind();
```

- This is Laravel’s default pagination style.

---

### **Conclusion**

- Laravel’s pagination system is highly flexible, supporting Tailwind CSS by default while allowing seamless integration with other frameworks like Bootstrap or custom views. Additionally, using eager loading in pagination ensures optimal performance by avoiding the N+1 problem. Customize your pagination views to match your application’s design and provide a polished user experience.

# Forms, CSRF Tokens, and Request Validation in Laravel

- Laravel provides robust tools to handle **forms**, protect against **CSRF attacks**, and enforce **request validation**. Let’s combine these concepts and see how they work together in a complete example.

---

### **1. Forms in Laravel**

- Forms in Laravel are used to capture and send data from the user to the server. They are implemented using standard HTML form elements, and Laravel enhances them with features like validation and error handling.

#### **Basic Structure**:

```html
<form method="POST" action="/blogs">
  @csrf
  <!-- Form Fields -->
  <input type="text" name="title" placeholder="Enter title" />
  <textarea name="content" placeholder="Enter content"></textarea>

  <button type="submit">Submit</button>
</form>
```

#### **Key Elements**:

1. **`method="POST"`**:
   - Specifies the HTTP method (e.g., POST, GET, PUT) for the request.
2. **`action="/blogs"`**:
   - URL where the form data is sent upon submission.
3. **`name` Attributes**:
   - Input names (`name="title"`, `name="content"`) map directly to the fields expected in the backend.

---

### **2. CSRF Tokens**

**CSRF (Cross-Site Request Forgery)** tokens are used to protect your forms from malicious attacks where unauthorized commands are performed on behalf of an authenticated user.

#### **How It Works**:

1. Laravel generates a unique token for each user session.
2. The token is embedded in every form using the `@csrf` directive.
3. When the form is submitted, Laravel verifies that the token matches the user's session token.

#### **Code Example**:

```html
<form method="POST" action="/blogs">
  @csrf
  <!-- Form Fields -->
  <input type="text" name="title" placeholder="Enter title" />
  <textarea name="content" placeholder="Enter content"></textarea>

  <button type="submit">Submit</button>
</form>
```

#### **Behind the Scenes**:

- The `@csrf` directive inserts a hidden input field with the token:
  ```html
  <input type="hidden" name="_token" value="csrf_token_value" />
  ```
- Laravel checks this token when the form is submitted to ensure the request is legitimate.

---

### **3. Request Validation**

- Validation ensures that the data submitted by users meets your application's requirements. Laravel provides a simple, expressive way to define and enforce validation rules.

#### **Validation Process**:

1. Define rules in the route or controller.
2. Use Laravel's `validate` method to check the data.
3. Handle errors if validation fails.

#### **Example Route with Validation**:

```php
Route::post('/blogs', function (Request $request) {
    $validated = $request->validate([
        'title' => ['required', 'max:255', 'min:4'],
        'content' => 'required|min:5',
    ]);

    // Save the validated data
    Post::create([...$validated, 'user_id' => 1]);

    return redirect('/blogs');
});
```

#### **Validation Rules**:

- `required`: Ensures the field is not empty.
- `max:255`: Limits the number of characters.
- `min:4`: Sets a minimum character length.
- Laravel automatically handles:
  - Redirecting back with errors if validation fails.
  - Passing errors to the view for display.

---

### **4. Handling Errors in Forms**

- When validation fails, Laravel sends error messages back to the form. You can display them using the `$errors` variable.

#### **Global Error Display**:

```php
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li class="text-red-600">{{ $error }}</li>
        @endforeach
    </ul>
@endif
```

#### **Field-Specific Errors**:

```php
<input type="text" name="title" value="{{ old('title') }}">
@error('title')
    <p class="text-red-600">{{ $message }}</p>
@enderror
```

- **`old('title')`**: Preserves the user’s input after validation fails.

---

### **5. Complete Example**

Let’s put everything together: forms, CSRF tokens, and validation.

#### **Route**:

```php
Route::post('/blogs', function (Request $request) {
    $validated = $request->validate([
        'title' => ['required', 'max:255', 'min:4'],
        'content' => 'required|min:5',
    ]);

    Post::create([...$validated, 'user_id' => 1]);

    return redirect('/blogs');
});
```

#### **Form View**:

```php
<x-layout>
    <x-slot:heading> Create Blog Post </x-slot:heading>
    <form method="POST" action="/blogs">
        @csrf

        <!-- Title Field -->
        <div>
            <label for="title">Title</label>
            <input
                type="text"
                name="title"
                id="title"
                value="{{ old('title') }}"
            />
            @error('title')
            <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Content Field -->
        <div>
            <label for="content">Content</label>
            <textarea name="content" id="content">
{{ old('content') }}</textarea
            >
            @error('content')
            <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit">Submit</button>
    </form>
</x-layout>
```

---

### **6. Workflow Summary**

1. **User Interaction**:
   - User fills out the form and submits it.
2. **CSRF Protection**:
   - Laravel verifies the CSRF token to ensure the request is legitimate.
3. **Validation**:
   - Laravel checks the submitted data against the defined rules.
   - If validation fails:
     - The user is redirected back to the form with error messages.
   - If validation passes:
     - The data is processed (e.g., saved to the database).
4. **Response**:
   - The user is redirected to the desired page (e.g., a blog list or success page).

- This setup ensures secure, user-friendly form handling in your Laravel application.

# Editing, Updating, and Deleting Resources in Laravel

- Laravel provides intuitive methods for editing, updating, and deleting resources using RESTful conventions. These operations are crucial for maintaining and managing application data.

---

### **1. Editing Resources**

- When editing a resource, you typically display the resource's existing data in a form, allowing the user to make changes.

#### **Edit Form**

- The edit form is similar to the creation form but pre-filled with the current values of the resource. The user modifies the fields and submits the form.

**Key Points**:

- Use a `GET` route for rendering the edit form.
- Pre-fill the form fields using the resource's current data.

#### **Example Route for Editing**:

```php
Route::get('/blogs/{id}/edit', function ($id) {
    $blog = Post::findOrFail($id); // Retrieve the blog by ID
    return view('edit', ['blog' => $blog]);
});
```

#### **Pre-Filling the Form**:

- In the Blade template:

```php
<input type="text" name="title" value="{{ old('title', $blog->title) }}">
<textarea name="content">{{ old('content', $blog->content) }}</textarea>
```

Here:

- `old()` ensures the user’s input is retained after validation errors.
- `old('field', $blog->field)` provides a fallback to the current value in case of no user input.

---

### **2. Updating Resources**

- Updating involves receiving the modified data from the edit form and saving it to the database.

#### **Update Route**:

- Laravel uses a `PUT` or `PATCH` request for updating:

```php
Route::put('/blogs/{id}', function (Request $request, $id) {
    $validated = $request->validate([
        'title' => ['required', 'max:255', 'min:4'],
        'content' => 'required|min:5',
    ]);

    $blog = Post::findOrFail($id);
    $blog->update($validated);

    return redirect('/blogs');
});
```

#### **HTML Form for Updating**:

```php
<form method="POST" action="/blogs/{{ $blog->id }}">
    @csrf
    @method('PUT') <!-- Spoofs a PUT request -->
    <input type="text" name="title" value="{{ old('title', $blog->title) }}">
    <textarea name="content">{{ old('content', $blog->content) }}</textarea>
    <button type="submit">Save Changes</button>
</form>
```

- `@method('PUT')` is required because HTML forms do not support `PUT` or `PATCH`.
- `Post::findOrFail($id)` ensures the resource exists or throws a 404 error.

---

### **3. Deleting Resources**

- Deleting involves removing a resource from the database. This operation uses a `DELETE` request.

#### **Delete Route**:

```php
Route::delete('/blogs/{id}', function ($id) {
    $blog = Post::findOrFail($id);
    $blog->delete();

    return redirect('/blogs');
});
```

#### **HTML Form for Deleting**:

```php
<form method="POST" action="/blogs/{{ $blog->id }}">
    @csrf
    @method('DELETE') <!-- Spoofs a DELETE request -->
    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
</form>
```

#### **Delete Workflow**:

1. User clicks the delete button.
2. A confirmation prompt appears (`onclick="return confirm()"`).
3. If confirmed, the `DELETE` request is sent to the server.
4. Laravel deletes the resource and redirects the user.

---

### **4. Combining Editing, Updating, and Deleting**

- Here’s how these operations work together in a resourceful controller setup.

#### **Controller**:

```php
use App\Models\Post;
use Illuminate\Http\Request;

// Display the edit form
public function edit($id) {
    $blog = Post::findOrFail($id);
    return view('edit', compact('blog'));
}

// Update the resource
public function update(Request $request, $id) {
    $validated = $request->validate([
        'title' => ['required', 'max:255', 'min:4'],
        'content' => 'required|min:5',
    ]);

    $blog = Post::findOrFail($id);
    $blog->update($validated);

    return redirect('/blogs');
}

// Delete the resource
public function destroy($id) {
    $blog = Post::findOrFail($id);
    $blog->delete();

    return redirect('/blogs');
}
```

#### **Routes**:

```php
Route::resource('blogs', BlogController::class);
```

- The `Route::resource` method automatically defines all RESTful routes, including:
  - `GET /blogs/{id}/edit` for editing.
  - `PUT /blogs/{id}` for updating.
  - `DELETE /blogs/{id}` for deleting.

---

### **5. Example Workflow**

#### **Edit Page**:

```php
<x-layout>
    <x-slot:heading>
        Edit Blog Post
    </x-slot:heading>
    <form method="POST" action="/blogs/{{ $blog->id }}">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" value="{{ old('title', $blog->title) }}">
            @error('title')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="content">Content</label>
            <textarea name="content">{{ old('content', $blog->content) }}</textarea>
            @error('content')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Save Changes</button>
    </form>
</x-layout>
```

#### **Delete Button**:

```html
<form method="POST" action="/blogs/{{ $blog->id }}">
  @csrf @method('DELETE')
  <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
</form>
```

---

### **6. Summary**

- **Editing**: Use `GET` to retrieve the resource and render a pre-filled form.
- **Updating**: Use `PUT` or `PATCH` to validate and save the modified data.
- **Deleting**: Use `DELETE` to remove the resource securely.
- Combine all these with resource controllers for cleaner and more maintainable code.

- This approach aligns with Laravel’s RESTful principles, making the application consistent and scalable.

# Controllers in Laravel

- Controllers in Laravel are classes that handle the logic for HTTP requests. Instead of defining all your request-handling logic in routes, controllers allow you to organize your code into reusable, maintainable methods. This helps separate concerns and keeps your application structure clean.

---

### **Defining a Controller**

- A controller is typically stored in the `app/Http/Controllers` directory. Laravel provides an Artisan command to create controllers:

```bash
php artisan make:controller BlogController
```

- This creates a file named `BlogController.php` inside the `app/Http/Controllers` directory.

**Example of a Basic Controller**:

```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // Logic for displaying a list of blogs
        return view('blogs.index');
    }

    public function show($id)
    {
        // Logic for displaying a single blog post
        return view('blogs.show', ['id' => $id]);
    }
}
```

---

### **Registering Controller Methods in Routes**

- To use a controller in your routes, you can specify the controller and method:

**Example**:

```php
use App\Http\Controllers\BlogController;

Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/blogs/{id}', [BlogController::class, 'show']);
```

- The first route points to the `index` method of `BlogController`.
- The second route points to the `show` method and passes the `{id}` parameter to it.

---

### **Resource Controllers**

- Laravel simplifies CRUD operations using resource controllers. A resource controller maps HTTP verbs (GET, POST, PUT, DELETE) to predefined controller methods.

You can create a resource controller using:

```bash
php artisan make:controller BlogController --resource
```

**Generated Methods in Resource Controller**:

- `index`: Display a listing of the resource.
- `create`: Show the form for creating a new resource.
- `store`: Handle storing a new resource.
- `show`: Display a specific resource.
- `edit`: Show the form for editing a specific resource.
- `update`: Handle updating a specific resource.
- `destroy`: Handle deleting a specific resource.

---

### **Example Resource Controller**

**Controller**:

```php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('blogs.index', compact('posts'));
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|min:4',
            'content' => 'required|min:5',
        ]);

        Post::create($validated);

        return redirect('/blogs');
    }

    public function show(Post $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    public function edit(Post $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, Post $blog)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|min:4',
            'content' => 'required|min:5',
        ]);

        $blog->update($validated);

        return redirect('/blogs');
    }

    public function destroy(Post $blog)
    {
        $blog->delete();

        return redirect('/blogs');
    }
}
```

**Routes**:

```php
use App\Http\Controllers\BlogController;

Route::resource('blogs', BlogController::class);
```

- This single line generates all necessary CRUD routes.

---

### **API Controllers in Laravel**

- API controllers in Laravel are specifically designed to handle API-related requests, typically providing JSON responses instead of rendering views. They streamline building RESTful APIs and follow similar principles to resource controllers but with API-specific conventions.

---

### **Creating an API Controller**

- To generate an API controller, use the `--api` flag:

```bash
php artisan make:controller ApiBlogController --api
```

- This creates a controller with methods for standard RESTful operations:
  - `index` - List resources
  - `store` - Create a new resource
  - `show` - Display a specific resource
  - `update` - Update a resource
  - `destroy` - Delete a resource

---

### **Defining API Routes**

- API controllers are typically grouped under `api.php` and use the `/api` prefix. Here's how to register routes for an API controller:

```php
use App\Http\Controllers\ApiBlogController;

Route::apiResource('blogs', ApiBlogController::class);
```

- This automatically generates API routes like:
  - `GET /api/blogs` → `index`
  - `POST /api/blogs` → `store`
  - `GET /api/blogs/{id}` → `show`
  - `PUT /api/blogs/{id}` → `update`
  - `DELETE /api/blogs/{id}` → `destroy`

---

### **Example API Controller**

- Here’s how an API controller might look for a blogging system:

```php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ApiBlogController extends Controller
{
    public function index()
    {
        return response()->json(Post::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|min:4',
            'content' => 'required|min:5',
        ]);

        $post = Post::create($validated);

        return response()->json($post, 201);
    }

    public function show(Post $blog)
    {
        return response()->json($blog, 200);
    }

    public function update(Request $request, Post $blog)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|min:4',
            'content' => 'required|min:5',
        ]);

        $blog->update($validated);

        return response()->json($blog, 200);
    }

    public function destroy(Post $blog)
    {
        $blog->delete();

        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
```

---

### **Key Features of API Controllers**

1. **JSON Responses**: Use `response()->json()` to return data.
2. **Validation**: Ensure incoming requests are validated to meet API requirements.
3. **HTTP Status Codes**: Provide proper status codes for success (`200`, `201`) and errors (`400`, `404`).
4. **Statelessness**: APIs are stateless and don’t use sessions; rely on tokens like **API tokens** or **JWT** for authentication.

---

- API controllers, combined with tools like **Laravel Sanctum** or **Passport**, make it easy to build secure and scalable APIs. This design is ideal for mobile apps or external systems that interact with your application.

---

# Route Model Binding in Laravel

- Route Model Binding is a powerful Laravel feature that allows you to automatically inject model instances into your routes based on route parameters. This simplifies your code, improves readability, and ensures you are always working with valid models.

---

### **How It Works**

- Instead of manually querying a model based on a route parameter, Laravel automatically retrieves the model instance when the parameter matches the model's ID or another attribute.

- For example:

```php
Route::get('/blogs/{blog}', function (Post $blog) {
    return view('blog.show', compact('blog'));
});
```

- In this route:
  1. The `{blog}` parameter matches the model `Post`.
  2. Laravel automatically queries the database and injects the corresponding `Post` instance into the `$blog` variable.

---

### **Types of Route Model Binding**

#### 1. **Implicit Binding**

- Implicit binding is the default behavior. Laravel determines the model to retrieve based on:
  - The route parameter name (e.g., `{blog}`).
  - The parameter's type hint in the route closure or controller method (e.g., `Post`).

**Example**:

```php
Route::get('/blogs/{blog}', function (Post $blog) {
    // $blog is an instance of the Post model
    return $blog;
});
```

- Here:

  - Laravel matches the `{blog}` route parameter to the `id` column in the `posts` table.
  - If no matching model is found, a `404 Not Found` response is returned automatically.

- By Default Laravel will use the id field to find the query, and the above query is the same as the following:

```php
Route::get('/blogs/{blog:id}', function (Post $blog) {
    return $blog;
});
```

- So if we want to quickly query using another fields in the databse, we can specify that field. Example: getting a blog by its slug:

```php
Route::get('/blogs/{blog:slug}', function (Post $blog) {
    return $blog;
});
```

---

#### 2. **Customizing the Key for Binding**

- By default, Laravel uses the `id` column to retrieve the model. You can customize this by overriding the `getRouteKeyName` method in the model.

**Example**:

- In the `Post` model:

```php
public function getRouteKeyName()
{
    return 'slug'; // Use the `slug` column instead of `id`
}
```

- Now, the following route will match the `slug` column:

```php
Route::get('/blogs/{blog}', function (Post $blog) {
    return $blog;
});
```

- Requesting `/blogs/my-first-post` will retrieve the `Post` model where `slug = 'my-first-post'`.

---

#### 3. **Explicit Binding**

- Explicit binding lets you manually define how a route parameter should be resolved. This is useful for complex scenarios or custom logic.

**Example**:

- In the `RouteServiceProvider`:

```php
use App\Models\Post;

public function boot()
{
    Route::model('blog', Post::class); // Bind the `blog` parameter to the Post model
}
```

- Or use a closure for custom logic:

```php
Route::bind('blog', function ($value) {
    return Post::where('slug', $value)->firstOrFail();
});
```

- Now, the route:

```php
Route::get('/blogs/{blog}', function (Post $blog) {
    return $blog;
});
```

- Will use the custom binding logic to resolve the `blog` parameter.

---

### **Using Route Model Binding in Controllers**

- Route model binding works seamlessly with controllers, especially resource controllers.

#### Example: Show Method in a Resource Controller

```php
public function show(Post $blog)
{
    // $blog is automatically resolved based on the route parameter
    return view('blogs.show', compact('blog'));
}
```

#### Resource Controller Routes:

```php
Route::resource('blogs', BlogController::class);
```

- This generates routes like `/blogs/{blog}`, which automatically resolves the `{blog}` parameter to a `Post` instance in the controller methods.

---

### **Route Model Binding and Validation**

- You can use route model binding with additional validation.

**Example**:

```php
Route::get('/blogs/{blog}', function (Post $blog) {
    abort_unless($blog->published, 403, 'Blog not published');
    return $blog;
});
```

- Here:
  - The `$blog` instance is resolved using route model binding.
  - Additional checks ensure the blog is published.

---

### **Error Handling**

- If no model is found during route model binding:

  - Laravel automatically throws a `ModelNotFoundException`.
  - By default, this results in a `404 Not Found` response.

- You can customize this behavior in the `render` method of `App\Exceptions\Handler`:

```php
public function render($request, Throwable $exception)
{
    if ($exception instanceof ModelNotFoundException) {
        return response()->view('errors.custom', [], 404);
    }

    return parent::render($request, $exception);
}
```

---

### **Benefits of Route Model Binding**

1. **Simplified Code**:

   - No need for explicit queries in routes or controllers.
   - Automatically injects the model instance.

2. **Improved Readability**:

   - Makes routes and controllers easier to understand.

3. **Error Handling**:

   - Ensures a `404` response for invalid parameters without extra code.

4. **Customizability**:
   - Easily customize binding logic using `getRouteKeyName` or explicit bindings.

---

### **Example: CRUD with Route Model Binding**

**Routes**:

```php
Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit']);
Route::put('/blogs/{blog}', [BlogController::class, 'update']);
Route::delete('/blogs/{blog}', [BlogController::class, 'destroy']);
```

**Controller**:

```php
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function edit(Post $blog)
    {
        // $blog is automatically resolved
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, Post $blog)
    {
        $validated = $request->validate([
            'title' => ['required', 'max:255', 'min:4'],
            'content' => 'required|min:5',
        ]);

        $blog->update($validated);
        return redirect('/blogs');
    }

    public function destroy(Post $blog)
    {
        $blog->delete();
        return redirect('/blogs');
    }
}
```

### **Benefits of Using Controllers with Route Model Binding**

1. **Code Reusability**: Controllers keep logic reusable across multiple routes.
2. **Readability**: Controllers improve code readability and maintainability.
3. **Automatic Error Handling**: Route model binding automatically handles invalid parameters with `404` responses.
4. **Flexibility**: Customizable binding logic ensures your application adapts to your data structure.

---

### **Conclusion**

- Route Model Binding is a Laravel feature that simplifies resource management by automatically resolving models for route parameters. It improves code clarity, enforces data consistency, and integrates seamlessly with RESTful routes and resource controllers. Whether you're using implicit or explicit binding, it helps create elegant, maintainable applications.

# Authentication in Laravel

- Authentication is a critical feature of most web applications. Laravel provides an easy-to-use and secure authentication system out of the box. It supports features like login, registration, password reset, email verification, and user roles.

---

### **How Laravel Handles Authentication**

1. **Guards**

- Guards define how users are authenticated. The default guard, `web`, uses sessions and cookies for stateful authentication. Other guards like `api` are available for token-based stateless authentication.

  Example from `config/auth.php`:

  ```php
  'guards' => [
      'web' => [
          'driver' => 'session',
          'provider' => 'users',
      ],

      'api' => [
          'driver' => 'token',
          'provider' => 'users',
          'hash' => false,
      ],
  ],
  ```

2. **User Providers**

- User providers define how users are retrieved from the database. By default, Laravel uses the `users` table and the `App\Models\User` model.

- Example:

```php
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],
],
```

3. **Middleware**

- Laravel includes middleware like `auth` to protect routes. It checks if a user is authenticated before granting access to the route.

Example:

```php
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');
```

---

### **Setting Up Authentication**

- Laravel offers several ways to set up authentication depending on your needs.

#### 1. **Using Starter Kits**

- The easiest way to add authentication is by using a starter kit like Laravel Breeze or Laravel Jetstream.  
  For details, see the explanation on [Starter Kits and Breeze](#starter-kits-in-laravel).

#### 2. **Manual Authentication Setup**

- If you prefer not to use a starter kit, you can manually set up authentication:

- **Step 1: Configure the User Model**

  - Ensure your `User` model exists and has the necessary fields like `name`, `email`, and `password`.

- **Step 2: Update Database Migrations**

  - Check the `users` table migration to ensure it matches your application's requirements.

  Example:

  ```php
  Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->rememberToken();
      $table->timestamps();
  });
  ```

- **Step 3: Create Authentication Controllers**

  - Laravel provides controllers to handle authentication, such as `LoginController`, `RegisterController`, and `ForgotPasswordController`. These can be customized as needed.

- **Step 4: Define Routes**

  - Define routes for login, registration, and logout in `routes/web.php`:

  ```php
  Route::get('/login', [LoginController::class, 'showLoginForm']);
  Route::post('/login', [LoginController::class, 'login']);
  Route::post('/logout', [LoginController::class, 'logout']);
  ```

- **Step 5: Protect Routes**
- You can protect routes using inline protecttion or using middlewares

- **Protect Routes with Inline Protection**
  - You can put the protection code inline(inside the controller)

```php
   public function edit(Post $blog){
        if(Auth::guest()) return redirect("/login");
        if($blog->author->isNot(Auth::user())) return abort(403);
        return view('blogs.edit', ['blog'=>$blog]);
    }
```

- **Protect Routes with Middleware**
  - Use the `auth` middleware to secure routes:
  ```php
  Route::get('/profile', function () {
      // Only authenticated users can access this route.
  })->middleware('auth');
  ```

---

### **Laravel Authentication Example**

#### Login Example

- Controller:

```php
use Illuminate\Support\Facades\Auth;

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return redirect()->intended('dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}
```

- View (Blade Template):

```html
<form method="POST" action="/login">
  @csrf
  <label for="email">Email</label>
  <input type="email" name="email" id="email" required />

  <label for="password">Password</label>
  <input type="password" name="password" id="password" required />

  <button type="submit">Login</button>
</form>
```

#### Logout Example

- Controller:

```php
public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}
```

- Route:

```php
Route::post('/logout', [AuthController::class, 'logout']);
```

---

### **Email Verification**

- Laravel includes email verification for additional security. To enable it:

1. Ensure the `users` table migration includes the `email_verified_at` column.
2. Use the `verified` middleware to protect routes:

   ```php
   Route::get('/dashboard', function () {
       return view('dashboard');
   })->middleware(['auth', 'verified']);
   ```

3. Send email verification links via the `MustVerifyEmail` interface:

   ```php
   use Illuminate\Contracts\Auth\MustVerifyEmail;

   class User extends Authenticatable implements MustVerifyEmail
   {
       // ...
   }
   ```

---

### **Password Reset**

- Laravel includes a password reset feature by default. Routes and controllers for this feature are included when you use starter kits like Breeze.

- **Request a Password Reset**  
   View for requesting a reset:

  ```html
  <form method="POST" action="/forgot-password">
    @csrf
    <input type="email" name="email" required />
    <button type="submit">Send Reset Link</button>
  </form>
  ```

- **Reset Password**
- After clicking the reset link in the email, users can reset their password:
  ```html
  <form method="POST" action="/reset-password">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}" />
    <input type="email" name="email" required />
    <input type="password" name="password" required />
    <input type="password" name="password_confirmation" required />
    <button type="submit">Reset Password</button>
  </form>
  ```

---

Here's where the code snippets you shared should be located in your Laravel project, organized by their purpose and location:

---

### **Authorization: Gates and Policies**

#### **Gates**

- **Defining Gates**

- Gates are best defined in the `boot` method of your `AppServiceProvider`. This is located in:

**File Path:** `app/Providers/AppServiceProvider.php`

**Example Code:**

```php
namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define('update-post', function ($user, $blog) {
            return $user->id === $blog->user_id;
        });
        // or
         Gate::define('update-post',function(User $user, Post $blog){
            return $blog->author->is($user);
        });
    }
}
```

---

- **Checking Gates**

- You can check Gates anywhere in your application, such as in controllers, middleware, or even Blade templates.

**Example Usage in Controller:**

```php
public function update(Post $post)
{
    if (Gate::allows('update-post', $post)) {
        // Perform the update
    }

    return response('Unauthorized', 403);

    // or
      Gate::authorize("update-post", $blog);
}
```

**Example Usage in Blade:**

```php
@can('update-post', $post)
    <button>Update Post</button>
@endcan
// or
@can('update-post', $blog)
    <x-button href="/blogs/{{ $blog->id }}/edit">Edit Post</x-button>
@endcan
```

**Example Usage in Routes:**

```php
Route::get('/blogs/{post}/edit',  "edit")->middleware(["auth", 'can:update-post,post']);
// or
Route::get('/blogs/{post}/edit',  "edit")->middleware(["auth"])->can('update-post', 'post');
```

---

#### **Policies**

- **Creating a Policy**

- Use the `artisan` command to generate a policy class. The class will be located in:

**File Path:** `app/Policies/PostPolicy.php` (or similar, depending on the model)

**Command to Generate Policy:**

```bash
php artisan make:policy PostPolicy --model=Post
```

---

- **Defining Policy Methods**

- Add your logic inside the generated policy file. For example:

**File Path:** `app/Policies/PostPolicy.php`

```php
namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}
```

---

- **Registering Policies**

- Register your policy in the `AuthServiceProvider`. This file is located in:

**File Path:** `app/Providers/AuthServiceProvider.php`

**Example Code:**

```php
namespace App\Providers;

use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Post::class => PostPolicy::class,
    ];
}
```

---

- **Using Policies**

- You can use policies directly in controllers or Blade files.

**In a Controller:**

```php
public function update(Post $post)
{
    $this->authorize('update', $post);

    // Update the post
}
```

**In Blade Templates:**

```php
@can('update', $post)
    <button>Update Post</button>
@endcan
```

**In Routes:**

```php
Route::get('/blogs/{post}/edit',  "edit")
    ->middleware("auth")
    ->can('edit', 'post'); //laravel will pickup that the post model is associated with a post policy class and get the edit there
```

---

### **Role-Based Access Control (RBAC)**

- Laravel supports RBAC through Gates and Policies. You can define roles in the `users` table or use packages like Spatie's Laravel Permissions for advanced functionality.

- If you're implementing RBAC:

1. **Define Roles:** Add a `role` column to your `users` table using a migration.

**Migration Example:**

```php
Schema::table('users', function (Blueprint $table) {
    $table->string('role')->default('user'); // e.g., 'admin', 'editor', 'user'
});
```

2. **Role Logic in Gates or Policies:**

- Add role-based checks in your Gates or Policies:

```php
Gate::define('manage-users', function ($user) {
    return $user->role === 'admin';
});
```

**In Blade:**

```php
@can('manage-users')
    <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
@endcan
```

3. **Using Spatie's Laravel Permissions:**

- For advanced role and permission management, consider using the [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission) package.

---

### **Authentication Examples**

- **Login Example**

- Login logic is typically placed in an authentication controller, like:

**File Path:** `app/Http/Controllers/Auth/LoginController.php`

**Example Code:**

```php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
}
```

---

### **Conclusion**

- Laravel’s authentication system is both powerful and easy to use. Whether you use starter kits like Laravel Breeze or implement it manually, the framework provides all the tools you need to secure your application.

# Route Groups in Laravel

- Route groups in Laravel are a powerful way to organize routes, apply shared attributes (such as middleware or prefixes), and reduce redundancy in your routing definitions. By grouping routes, you can streamline the configuration and make your code more maintainable.

---

### **Defining a Route Group**

Route groups are created using the `Route::group` method. You pass an array of shared attributes and a closure containing the routes to the method:

```php
Route::group(['middleware' => 'auth'], function () {
  Route::controller(BlogController::class)->group(function(){
    Route::get("/blogs","index");
    Route::get('/blogs/create', "create");
    Route::get('/blogs/{post}',  "show");
    Route::post('/blogs',  "store" );
    Route::get('/blogs/{post}/edit',  "edit");
    Route::put('/blogs/{post}',  "update");
    Route::delete('/blogs/{post}',"destroy");
});
```

- Route Groups with middleware

```php
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'show']);
});
```

In this example:

- Both routes share the `auth` middleware, ensuring only authenticated users can access these routes.

---

### **Common Use Cases for Route Groups**

1. **Middleware**: Apply middleware to a set of routes.
2. **Prefixes**: Add a common prefix to route URLs.
3. **Namespaces**: Organize controllers under a shared namespace.
4. **Subdomains**: Define routes that belong to specific subdomains.
5. **Localization**: Group routes under a specific locale.

---

### **Using Route Group Attributes**

1. **Middleware**

   Apply middleware to all routes within the group:

   ```php
   Route::group(['middleware' => ['auth', 'verified']], function () {
       Route::get('/settings', [SettingsController::class, 'index']);
       Route::get('/account', [AccountController::class, 'index']);
   });
   ```

2. **Prefixes**

   Add a shared prefix to the routes:

   ```php
   Route::group(['prefix' => 'admin'], function () {
       Route::get('/users', [AdminUserController::class, 'index']);
       Route::get('/settings', [AdminSettingsController::class, 'index']);
   });
   ```

   - The resulting URLs would be `/admin/users` and `/admin/settings`.

3. **Namespaces**

   Specify a namespace for controllers:

   ```php
   Route::group(['namespace' => 'Admin'], function () {
       Route::get('/dashboard', 'DashboardController@index');
       Route::get('/reports', 'ReportsController@index');
   });
   ```

   - Controllers `DashboardController` and `ReportsController` are located in the `App\Http\Controllers\Admin` namespace.

4. **Subdomains**

   Define routes for a specific subdomain:

   ```php
   Route::group(['domain' => '{account}.example.com'], function () {
       Route::get('/dashboard', [DashboardController::class, 'index']);
   });
   ```

   - `{account}` is a wildcard, allowing dynamic subdomain routing.

5. **Localization**

   Group routes for localized URLs:

   ```php
   Route::group(['prefix' => '{locale}', 'middleware' => 'setLocale'], function () {
       Route::get('/about', [AboutController::class, 'index']);
       Route::get('/contact', [ContactController::class, 'index']);
   });
   ```

   - URLs like `/en/about` or `/fr/about` are supported.

---

### **Route Group Nesting**

You can nest route groups to combine attributes:

```php
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'show']);
    });
});
```

- The resulting URLs would be `/admin/users` and `/admin/users/{id}`, with the `auth` middleware applied to both.

---

### **Best Practices for Route Groups**

1. **Reduce Redundancy**: Use groups to avoid repeating attributes like middleware or prefixes for each route.
2. **Organize Logically**: Group related routes (e.g., admin routes, API routes, or user routes).
3. **Readability**: Keep the code clean and structured by nesting or grouping similar routes.

---

### **Example: Comprehensive Route Group**

```php
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);
    Route::get('/users', [AdminUserController::class, 'index']);
    Route::post('/users', [AdminUserController::class, 'store']);
});
```

- **Prefix**: All routes are prefixed with `/admin`.
- **Middleware**: Both `auth` and `admin` middleware ensure only authenticated admin users can access these routes.
- **Routes**: The routes handle admin-specific functionalities.

---

### **When to Use Route Groups**

1. **Repetitive Middleware or Prefixes**: When multiple routes share the same middleware, prefix, or namespace.
2. **Project Organization**: For keeping routes logically grouped (e.g., separating API, admin, and public routes).
3. **Localization and Subdomains**: To handle dynamic subdomains or localized URLs.

# Route Resources in Laravel

- Route resources in Laravel provide a convenient way to define routes for CRUD (Create, Read, Update, Delete) operations. With a single line of code, you can generate all the necessary routes for interacting with a specific resource (e.g., `posts`, `users`, or `products`).

---

### **Defining a Resource Route**

- You can define a resource route using the `Route::resource` method. For example:

```php
Route::resource('posts', PostController::class);
```

- This single line generates the following routes:

| HTTP Method | URL                | Action  | Controller Method | Purpose                    |
| ----------- | ------------------ | ------- | ----------------- | -------------------------- |
| GET         | /posts             | index   | `index`           | Display all posts          |
| GET         | /posts/create      | create  | `create`          | Show form to create a post |
| POST        | /posts             | store   | `store`           | Save a new post            |
| GET         | /posts/{post}      | show    | `show`            | Display a specific post    |
| GET         | /posts/{post}/edit | edit    | `edit`            | Show form to edit a post   |
| PUT/PATCH   | /posts/{post}      | update  | `update`          | Update a specific post     |
| DELETE      | /posts/{post}      | destroy | `destroy`         | Delete a specific post     |

---

### **Controller for Resource Routes**

- The corresponding controller (e.g., `PostController`) must have methods for each route:

```php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // Display all posts
    }

    public function create()
    {
        // Show form to create a new post
    }

    public function store(Request $request)
    {
        // Save the new post
    }

    public function show(Post $post)
    {
        // Display a specific post
    }

    public function edit(Post $post)
    {
        // Show form to edit a specific post
    }

    public function update(Request $request, Post $post)
    {
        // Update the post
    }

    public function destroy(Post $post)
    {
        // Delete the post
    }
}
```

---

### **Customizing Resource Routes**

1. **Limiting the Routes**

   - If you don't need all the routes, you can specify which ones to include using the `only` or `except` options:

   ```php
   Route::resource('posts', PostController::class)->only(['index', 'show']);
   Route::resource('posts', PostController::class)->except(['create', 'edit']);
   ```

2. **Changing Route Names**

   - You can customize the route names using the `names` option:

   ```php
   Route::resource('posts', PostController::class)->names([
       'index' => 'posts.list',
       'show' => 'posts.view',
   ]);
   ```

3. **Customizing Route Parameters**

   - You can change the default `{id}` parameter using the `parameters` option:

   ```php
   Route::resource('posts', PostController::class)->parameters([
       'posts' => 'post_id',
   ]);
   ```

   - The route `/posts/{post_id}` will now use `post_id` instead of the default `post`.

4. **Route Prefixes**

   - Use the `prefix` method to group resource routes under a specific URL prefix:

   ```php
   Route::prefix('admin')->group(function () {
       Route::resource('posts', PostController::class);
   });
   ```

   - The routes will now be prefixed with `/admin`, e.g., `/admin/posts`.

---

### **API Resource Routes**

- For API development, Laravel provides the `Route::apiResource` method, which generates resource routes without the `create` and `edit` routes (since forms are not used in APIs):

```php
Route::apiResource('posts', PostController::class);
```

- This generates the following routes:

| HTTP Method | URL           | Action  | Controller Method |
| ----------- | ------------- | ------- | ----------------- |
| GET         | /posts        | index   | `index`           |
| POST        | /posts        | store   | `store`           |
| GET         | /posts/{post} | show    | `show`            |
| PUT/PATCH   | /posts/{post} | update  | `update`          |
| DELETE      | /posts/{post} | destroy | `destroy`         |

---

### **Middleware with Resource Routes**

- You can apply middleware to a resource route just like any other route:

```php
Route::resource('posts', PostController::class)->middleware('auth');
```

---

### **Benefits of Resource Routes**

1. **Convenience**: Define all CRUD routes with minimal code.
2. **Consistency**: Encourages a uniform structure for resource management.
3. **Customizability**: Easily adapt to your project's requirements with options like `only`, `except`, or custom parameters.

---

### **Resource Routes Best Practices**

1. Use `Route::resource` for standard CRUD operations to save time and maintain uniformity.
2. Limit routes with `only` or `except` if not all CRUD actions are needed.
3. Use API resources (`Route::apiResource`) for RESTful APIs, as it eliminates unnecessary routes like `create` and `edit`.
4. Always pair resource routes with meaningful controller methods for clarity and maintainability.

# Starter Kits in Laravel

- Laravel provides starter kits to help developers quickly scaffold common features in a web application, such as authentication, registration, and password reset functionalities. These kits eliminate the need to manually set up these features, saving time and effort while following best practices.

---

### **Types of Starter Kits**

1. **Laravel Breeze**

   - Lightweight and minimal.
   - Provides basic authentication features like login, registration, password reset, email verification, and profile updates.
   - Uses simple Blade templates or Inertia.js (with Vue or React) for the frontend.
   - Ideal for small projects or developers who prefer a minimal setup.

2. **Laravel Jetstream**

   - More advanced than Breeze.
   - Includes features like two-factor authentication, API token management, team management, and session management.
   - Works with Blade or Inertia.js (with Vue or React).
   - Suitable for applications requiring additional features beyond basic authentication.

3. **Laravel UI**
   - Provides the frontend scaffolding for authentication using Bootstrap, Vue.js, or React.
   - Predates Breeze and Jetstream.
   - Requires manual installation of npm dependencies and compilation.

---

### **Laravel Breeze: A Closer Look**

#### **Installation**

- Laravel Breeze can be installed with a single command:

```bash
composer require laravel/breeze --dev
php artisan breeze:install
```

- You can specify the stack (Blade, Vue, or React with Inertia.js) during installation:

```bash
php artisan breeze:install blade
php artisan breeze:install react
php artisan breeze:install vue
```

#### **Setup**

1. After installation, run the following commands to compile frontend assets and migrate the database:

```bash
npm install
npm run dev
php artisan migrate
```

2. The above commands scaffold basic authentication views and logic.

---

#### **Features of Breeze**

- **Blade Stack**: Provides a traditional Blade-based approach with minimal JavaScript.
- **Inertia Stack**: Uses modern single-page applications (SPA) powered by Vue or React with server-side routing.
- **Simple and Extendable**: Minimal structure that allows developers to easily build upon it.
- **Prebuilt Routes and Controllers**:
  - Authentication routes (`/login`, `/register`, `/logout`, etc.).
  - Controllers for handling authentication actions like `AuthenticatedSessionController`, `RegisteredUserController`, and more.

---

#### **Example Files in Breeze (Blade)**

1. **Routes**:

- Routes for Breeze are predefined in `routes/web.php`:

```php
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
```

2. **Views**:

- Authentication views are stored in `resources/views/auth` (e.g., `login.blade.php`, `register.blade.php`).

3. **Controllers**:

- Authentication logic resides in `App\Http\Controllers\Auth`.

---

### **Middlewares in Laravel**

- Middlewares are filters that sit between the request and response of an application. They provide a mechanism to inspect, modify, or handle requests before they reach the controller or responses before they are sent back to the client.

---

#### **Common Uses of Middleware**

1. **Authentication**: Restrict access to routes based on user authentication.
2. **Authorization**: Check if a user has permission to perform a certain action.
3. **CSRF Protection**: Ensure the request comes from the authenticated user.
4. **Logging**: Log details of requests and responses.
5. **Maintenance Mode**: Temporarily disable access during maintenance.

---

#### **Built-in Middleware in Laravel**

Laravel comes with several prebuilt middlewares, such as:

- `auth`: Ensures the user is authenticated.
- `guest`: Redirects authenticated users from guest-only pages.
- `throttle`: Limits the number of requests to prevent abuse.
- `verified`: Ensures the user has verified their email.

---

#### **Creating Custom Middleware**

- You can create custom middleware using the `make:middleware` artisan command:

```bash
php artisan make:middleware CheckUserType
```

- This creates a file in `app/Http/Middleware`. Modify the `handle` method:

```php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserType
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->type !== 'admin') {
            return redirect('home');
        }

        return $next($request);
    }
}
```

---

#### **Registering Middleware**

1. **Global Middleware**:

- Register in `app/Http/Kernel.php` under the `$middleware` array.

2. **Route Middleware**:

- Register in the `$routeMiddleware` array of the same file:

```php
'check.type' => \App\Http\Middleware\CheckUserType::class,
```

- Then apply to routes:

```php
Route::middleware(['check.type'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
});
```

---

#### **Middleware Groups**

- Middleware groups allow combining multiple middlewares under a single name for simplicity. For example:

```php
'web' => [
    \App\Http\Middleware\EncryptCookies::class,
    \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
    \Illuminate\Session\Middleware\StartSession::class,
    // Other web middlewares
],
```

---

### **Combining Breeze and Middleware**

1. Breeze uses the `auth` middleware to secure routes like `/dashboard`.
2. Middleware like `verified` ensures users verify their email before accessing certain routes.

- By combining Breeze's scaffolding and Laravel's middleware, you can build robust and secure web applications quickly.

# Emails in Laravel

- Laravel provides a clean, simple, and flexible API to send emails. It supports various email drivers like SMTP, Mailgun, Postmark, Amazon SES, and more.

---

### **Setting Up Emails**

1. **Configure Email Settings**

- Laravel's email settings are defined in the `.env` file. Here’s an example for SMTP:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=example@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

- Supported mailers include:

  - SMTP
  - Mailgun
  - Postmark
  - Amazon SES
  - Sendmail
  - Log

- The corresponding configuration can be found in **`config/mail.php`**.

---

### **Sending Emails**

1. **Using the `Mail` Facade**

- You can send emails using the `Mail` facade.

- Example:

```php
use Illuminate\Support\Facades\Mail;

Mail::to('recipient@example.com')->send(new \App\Mail\WelcomeEmail());
```

2. **Creating Mailable Classes**

- Mailables are responsible for constructing email messages. Generate a Mailable using:

```bash
php artisan make:mail WelcomeEmail
```

- This will create a new file in **`app/Mail/WelcomeEmail.php`**.

---

### **Example: Welcome Email**

1. **Define the Mailable**

- **File:** `app/Mail/WelcomeEmail.php`

```php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.welcome')
                    ->subject('Welcome to Our Application')
                    ->with(['user' => $this->user]);
    }
    // or
    public function __construct(public User $user)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Account Created',
        );
    }

     public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
        );
    }
    // email subject and variable injecting is all done by laravel

}
```

> By default the data passed to the mailer's constructor is public and all instances of the mailable class are availe to the template, meaning the emailing template file has access to it all, if you want it to have access to only specific fields you can make it protected and send only the required data.

```php
public function __construct(protected User $user)
{
        //
}
public function content(): Content
{
    return new Content(
        view: 'mail.post-created',
        with:["name"=>$user->name]
    );
}
```

2. **Create the Email View**

- **File:** `resources/views/emails/welcome.blade.php`

```html
<!DOCTYPE html>
<html>
  <head>
    <title>Welcome Email</title>
  </head>
  <body>
    <h1>Hello, {{ $user->name }}!</h1>
    <p>Welcome to our application. We're glad to have you here!</p>
  </body>
</html>
```

3. **Send the Email**

- **Example Usage:**

```php
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

public function sendWelcomeEmail(User $user)
{
    Mail::to($user->email)->send(new WelcomeEmail($user));
}
```

---
