<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Profile};
use Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        return view("auth.login");
    }

    public function register(Request $request) {
        return view("auth.register");
    }

    public function storeLogin(Request $request) {
        $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route("dashboard");
        }

        return redirect()->back()->with("notMatch", "email or password not match");
    }

    public function storeRegister(Request $request) {
        $request->validate([
            "email" => "required|email",
            "password" => "required",
            "name" => "required",
            "phone" => "required",
            "address" => "required"
        ]);

        $profiles = Profile::create([
            "address" => $request->address,
            "phone" => $request->phone
        ]);        

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "profile_id" => $profiles->id
        ]);

        return redirect()->route("login");
    }

    public function logout(Request $request) {
        Auth::logout();

        return redirect()->route("login");
    }
}