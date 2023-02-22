<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\isEmpty;

class Login extends Controller
{
    
    public function LoginShow()
    {
        $username = Session::get('username');
        if(isset($username)){
            Session::reflash();
            return redirect('/d');
        }else{
            return view('users.login')->with([
                'status' => null,
            ]);

        }
    }
    public function RegistrationSHow()
    {
        $username = Session::get('username');
        if(isset($username)){
            Session::reflash();
            return redirect('/d');
        }else{
            return view('users.registration');
        }
    }

    public function register(Request $request)
    {
        $user_data = $request->validate([
            'full_name' => 'required|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:8|alphanum',
            'telephone' => 'required|numeric'
        ]);
        User::create($user_data);

        return view('users.login')->with([

            'code' => '100',
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
        
        foreach($user_data as $user){
            if ($login_data['password'] == $user->password) {
                Session::flash(
                    'status',
                    'Logged In successfully',
                );
                Session::flash(
                    'username',
                    $user->username
                );
                return redirect('/d');
            } 
                 else {
                return view('users.login')->with([
                    'code' => '101',
                    'status' => 'Log In Failed, please check your password'
                ]);
            }
            
    }
    return view('users.login')->with([
        'code' => '101',
        'status' => "Account doesn't exist, please register"
    ]);
    }

    public function logout(){
        Session::remove('username');
        return view('users.login')->with([
            'status' => null,
        ]);
    }
}
