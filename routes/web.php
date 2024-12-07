<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {


    return view('home');
});
Route::get('/blogs', function () {
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
    return view('blogs', ['blogs'=>$blogs]);
});
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

Route::get('/contact', function () {
    return view('contact');
});
