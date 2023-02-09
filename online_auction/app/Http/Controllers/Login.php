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
        return view('users.login')->with([
            'status' => null,
        ]);
    }
    public function RegistrationSHow()
    {
        return view('users.registration');
    }

    public function register(Request $request)
    {
        $user_data = $request->validate([
            'full_name' => 'required|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
            'telephone' => 'required|numeric'
        ]);
        User::create($user_data);

        return view('users.login')->with([
            'status' => 'Signed Up successfully! Please Log In'
        ]);
        // User::('insert into users (user_id, full_name, username, password, telephone) values (?, ?,?,?,?)', [null, $user_data['full_name'], $user_data['username'], $user_data['password'], $user_data['telephone']]);
    }

    public function Login(Request $request)
    {
        // dd($request);
        if ($request) {

            return view('home')->with(['username' => $request->username]);
        }
    }
}
