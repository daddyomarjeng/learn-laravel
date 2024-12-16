<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {


    return view('home');
});

// create
Route::get('/blogs/create', function () {

    return view('blogs.create');
});

// get all
Route::get('/blogs', function () {
    // $blogs = Post::all();
    // $blogs = Post::with("author")->with("tags")->get();
    // $blogs = Post::with("author")->with("tags")->cursorPaginate(5);
    // $blogs = Post::with("author")->with("tags")->paginate(5);
    $blogs = Post::with("author")->with("tags")->latest()->simplePaginate(5);
    return view('blogs.index', ['blogs'=>$blogs]);
});


// get single
Route::get('/blogs/{id}', function ($id) {

//    $post =  Arr::first($blogs, function($blog) use($id) {
//         return $blog['id'] == $id;
//     });

    // $post = ARR::first($blogs, fn($blog)=>$blog['id'] == $id);
    // dd($post);

    $post = Post::find($id);
    return view('blogs.show', ['blog'=>$post]);
});

// create
Route::post('/blogs', function (Request $request) {
    $validated = $request->validate([
        'title' => ['required', 'max:255', 'min:4'],
        'content' => 'required|min:5',
    ]);

    Post::create([...$validated, "user_id"=>1]);

    return redirect('/blogs');
});

// show edit page
Route::get('/blogs/{id}/edit', function ($id) {

    $post = Post::findOrFail($id); // Retrieve the blog by ID
    return view('blogs.edit', ['blog'=>$post]);
});

// edit
Route::put('/blogs/{id}', function (Request $request, $id) {
    $validated = $request->validate([
        'title' => ['required', 'max:255', 'min:4'],
        'content' => 'required|min:5',
    ]);

    $blog = Post::findOrFail($id);
    $blog->update($validated);

    return redirect('/blogs/' .  $blog->id);
});

// delete
Route::delete('/blogs/{id}', function ($id) {
    $blog = Post::findOrFail($id);
    $blog->delete();

    return redirect('/blogs');
});

Route::get('/contact', function () {
    return view('contact');
});
