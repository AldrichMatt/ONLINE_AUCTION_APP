<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
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

        return redirect('/login')->with([
            'status' => 'Signed Up successfully! Please Log In'
        ]);
    }

    public function Login(Request $request)
    {
        $login_data = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user_data = User::all()->where('username', $login_data['username']);
        foreach ($user_data as $user) {
            echo $user->username . "\n";
            echo $user->password . "\n";
        }
    }
}
