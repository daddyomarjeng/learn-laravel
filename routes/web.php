<?php

use App\Models\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {


    return view('home');
});
Route::get('/blogs', function () {
    // $blogs = Post::all();
    $blogs = Post::with("author")->with("tags")->get();
    return view('blogs', ['blogs'=>$blogs]);
});
Route::get('/blogs/{id}', function ($id) {

//    $post =  Arr::first($blogs, function($blog) use($id) {
//         return $blog['id'] == $id;
//     });

    // $post = ARR::first($blogs, fn($blog)=>$blog['id'] == $id);
    // dd($post);

    $post = Post::find($id);
    return view('blog', ['blog'=>$post]);
});

Route::get('/contact', function () {
    return view('contact');
});