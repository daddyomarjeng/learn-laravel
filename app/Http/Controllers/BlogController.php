<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        $blogs = Post::with("author")->with("tags")->latest()->simplePaginate(5);
            return view('blogs.index', ['blogs'=>$blogs]);
    }
    public function create(){
        return view('blogs.create');
    }
    public function show(Post $post){
    return view('blogs.show', ['blog'=>$post]);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'title' => ['required', 'max:255', 'min:4'],
            'content' => 'required|min:5',
        ]);

        Post::create([...$validated, "user_id"=>1]);

        return redirect('/blogs');

    }
    public function edit(Post $post){
        return view('blogs.edit', ['blog'=>$post]);
    }
    public function update(Request $request, Post $post){
        $validated = $request->validate([
            'title' => ['required', 'max:255', 'min:4'],
            'content' => 'required|min:5',
        ]);

        $post->update($validated);

        return redirect('/blogs/' .  $post->id);
    }
    public function destroy(Post $post){
        $post->delete();
        return redirect('/blogs');
    }
}