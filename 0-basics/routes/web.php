<?php

use App\Http\Controllers\BlogController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;


Route::view('/', 'home');
Route::view('/contact', 'contact');
// Blogs Routes
Route::resource("/blogs", BlogController::class);



// // Blogs Routes
// Route::controller(BlogController::class)->group(function(){
//     Route::get("/blogs","index");
//     Route::get('/blogs/create', "create");
//     Route::get('/blogs/{post}',  "show");
//     Route::post('/blogs',  "store" );
//     Route::get('/blogs/{post}/edit',  "edit");
//     Route::put('/blogs/{post}',  "update");
//     Route::delete('/blogs/{post}',"destroy");
// });


// // home
// Route::view('/', 'home');

// // contact
// Route::view('/contact', 'contact');

// // Blogs Routes
// // get all
// Route::get("/blogs", [BlogController::class, "index"]);

// // create
// Route::get('/blogs/create', [BlogController::class, "create"]);

// // get single
// Route::get('/blogs/{post}', [BlogController::class, "show"]);

// // store
// Route::post('/blogs', [BlogController::class, "store"] );

// // show edit page
// Route::get('/blogs/{post}/edit', [BlogController::class, "edit"]);

// // update
// Route::put('/blogs/{post}', [BlogController::class, "update"]);

// // delete
// Route::delete('/blogs/{post}', [BlogController::class, "destroy"]);


// Route::get('/', function () {


//     return view('home');
// });

// // get all
// // Route::get('/blogs', function () {
// //     // $blogs = Post::all();
// //     // $blogs = Post::with("author")->with("tags")->get();
// //     // $blogs = Post::with("author")->with("tags")->cursorPaginate(5);
// //     // $blogs = Post::with("author")->with("tags")->paginate(5);
// //     // $blogs = Post::with("author")->with("tags")->latest()->simplePaginate(5);
// //     // return view('blogs.index', ['blogs'=>$blogs]);
// // });

// // create
// Route::get('/blogs/create', function () {

//     return view('blogs.create');
// });


// // get single
// // Route::get('/blogs/{id}', function ($id) {
// Route::get('/blogs/{post}', function (Post $post) {

// //    $post =  Arr::first($blogs, function($blog) use($id) {
// //         return $blog['id'] == $id;
// //     });

//     // $post = ARR::first($blogs, fn($blog)=>$blog['id'] == $id);
//     // dd($post);

//     // $post = Post::find($id);
//     return view('blogs.show', ['blog'=>$post]);
// });

// // create
// Route::post('/blogs', function (Request $request) {
//     $validated = $request->validate([
//         'title' => ['required', 'max:255', 'min:4'],
//         'content' => 'required|min:5',
//     ]);

//     Post::create([...$validated, "user_id"=>1]);

//     return redirect('/blogs');
// });

// // show edit page
// Route::get('/blogs/{post}/edit', function (Post $post) {

//     // $post = Post::findOrFail($id); // Retrieve the blog by ID
//     return view('blogs.edit', ['blog'=>$post]);
// });

// // edit
// Route::put('/blogs/{post}', function (Request $request, Post $post) {
//     $validated = $request->validate([
//         'title' => ['required', 'max:255', 'min:4'],
//         'content' => 'required|min:5',
//     ]);

//     // $blog = Post::findOrFail($id);
//     $post->update($validated);

//     return redirect('/blogs/' .  $post->id);
// });

// // delete
// Route::delete('/blogs/{post}', function (Post $post) {
//     // $blog = Post::findOrFail($id);
//     $post->delete();

//     return redirect('/blogs');
// });

// Route::get('/contact', function () {
//     return view('contact');
// });