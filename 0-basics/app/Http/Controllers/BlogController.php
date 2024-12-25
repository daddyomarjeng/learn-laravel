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
    public function show(Post $blog){
        // dd($blog);
    return view('blogs.show', ['blog'=>$blog]);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'title' => ['required', 'max:255', 'min:4'],
            'content' => 'required|min:5',
        ]);

        Post::create([...$validated, "user_id"=>1]);

        return redirect('/blogs');

    }
    public function edit(Post $blog){
        return view('blogs.edit', ['blog'=>$blog]);
    }
    public function update(Request $request, Post $blog){
        $validated = $request->validate([
            'title' => ['required', 'max:255', 'min:4'],
            'content' => 'required|min:5',
        ]);

        $blog->update($validated);

        return redirect('/blogs/' .  $blog->id);
    }
    public function destroy(Post $blog){
        $blog->delete();
        return redirect('/blogs');
    }
}