<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(){
        return view('auth.login');
    }
    public function store(Request $request){
         // validate
         $validated = $request->validate(
            [
                "email"=> ["required", "email"],
                "password"=> ["required"],
            ]
            );

        // attempt login(can add additional parameter to enable remember user)
       $isLoggedIn =  Auth::attempt($validated);

       if(!$isLoggedIn) {
        throw ValidationException::withMessages([
            "email"=>"Invalid credentials"
        ]);
       }
        // regerate session
            $request->session()->regenerate();

        // redirect
        return redirect("blogs");
    }
    public function destroy(){
        Auth::logout();
        return redirect("/");
    }
}