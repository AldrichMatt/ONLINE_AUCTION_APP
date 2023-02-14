<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Offer extends Controller
{
    public function OfferShow(){

        $username = Session::get('username');
        if($username ==  null || $username == 'Guest'){
            return redirect('/d');
        }else{
            Session::reflash();
            return view('users.offers')->with([
                'username' => $username,
            ]);

        }


    }
}
