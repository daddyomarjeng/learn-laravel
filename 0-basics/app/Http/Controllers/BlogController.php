<?php

namespace App\Http\Controllers;

use App\Mail\PostCreated;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

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
        // dd($blog);
    return view('blogs.show', ['blog'=>$post]);
    }
    public function store(Request $request){
        $validated = $request->validate([
            'title' => ['required', 'max:255', 'min:4'],
            'content' => 'required|min:5',
        ]);

        $post  = Post::create([...$validated, "user_id"=>1]);
        Mail::to($post->author)->send(
            new PostCreated($post)
        );
        return redirect('/blogs');

    }
    public function edit(Post $post){
        // if(Auth::guest()) return redirect("/login");
        // if($blog->author->isNot(Auth::user())) return abort(403);
        // Gate::authorize("update-post", $post);
        return view('blogs.edit', ['blog'=>$post]);
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