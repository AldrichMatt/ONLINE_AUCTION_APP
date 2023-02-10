<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Exists;

class Home extends Controller
{
    public function HomeShow()
    {
        $username = Session::get('username');
        Session::reflash();
        // dd($username);
        if (isset($username) == true) {
            return view('home')->with(['username' => $username]);
        } else {
            return view('home')->with(['username' => 'Guest']);
        }
    }
}
