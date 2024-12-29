<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create(){
        return view("auth.register");
    }
    public function store(Request $request){

        // validate
        $validated = $request->validate(
            [
                "name"=> ["required"],
                "email"=> ["required", "email", "max:254"],
                "password"=> ["required", Password::min(5)->letters()->numbers(), 'confirmed'],
            ]
            );
        // create
           $user =  User::create($validated);

        // login
        Auth::login($user);

        // redirect
        return redirect("blogs");
    }
}