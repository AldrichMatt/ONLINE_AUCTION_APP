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
        $validator = $request->validate([
            'full_name' => 'required|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
            'telephone' => 'required|numeric'
        ]);

        return view('users.login');
        session()->flash('status', 'Signed Up succesfully please Log In');
    }

    public function Login(Request $request)
    {
        // dd($request);
        if ($request) {

            return view('home')->with(['username' => $request->username]);
        }
    }
}
