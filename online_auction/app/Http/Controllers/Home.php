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
        $level = Session::get('level');
        Session::reflash();
        // dd($username);
        if (isset($level)) {
            Session::reflash();
            return redirect('/admin/d');
        } else if (isset($username) == true) {
            Session::reflash();
            return view('home')->with(['username' => $username]);
        } else {
            return view('home')->with(['username' => 'Guest']);
        }
    }
}
