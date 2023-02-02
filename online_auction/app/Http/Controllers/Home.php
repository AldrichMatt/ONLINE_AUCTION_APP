<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Home extends Controller
{
    public function HomeShow()
    {
        return view('home')->with('title',"Homepage");
    }
}
