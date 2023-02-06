<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class Login extends Controller
{
    public function LoginShow()
    {
        return view('login');
    }
    public function RegistrationSHow()
    {
        return view('registration');
    }

}
