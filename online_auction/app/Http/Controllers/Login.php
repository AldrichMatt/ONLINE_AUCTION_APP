<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Validation\Rule;

class Login extends Controller
{
    public function LoginShow()
    {
        return view('users.login');
    }
    public function RegistrationSHow()
    {
        return view('users.registration');
    }

    public function register(Request $request)
    {
    }

    public function Login(Request $request)
    {
        $formFields = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/d')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['username' => 'Invalid Credentials'])->onlyInput('username');
    }
}
