<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\isEmpty;

class Admin extends Controller
{

    public function LoginShow()
    {
        $username = Session::get('username');
        if (isset($username)) {
            Session::reflash();
            return redirect('/d');
        } else {
            return view('admin.login')->with([
                'status' => null,
            ]);
        }
    }
    public function RegistrationSHow()
    {
        $username = Session::get('username');
        if (isset($username)) {
            Session::reflash();
            return redirect('/d');
        } else {
            return view('admin.registration');
        }
    }

    public function register(Request $request)
    {
        $employee_data = $request->validate([
            'employee_name' => 'required|unique:employees',
            'username' => 'required|unique:employees',
            'password' => 'required|min:8|alphanum',
            'level' => 'required'
        ]);
        Employee::create($employee_data);

        return view('admin.login')->with([
            'code' => '100',
            'status' => 'Signed Up successfully! your data will be processed shortly'
        ]);
    }

    public function Login(Request $request)
    {


        $login_data = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $employee_data = Employee::all()->where('username', $login_data['username']);

        foreach ($employee_data as $employee) {
            if ($login_data['password'] == $employee->password) {
                if ($employee->level == 1 || $employee->level == 2) {
                    Session::flash(
                        'status',
                        'Logged In successfully',
                    );
                    Session::flash(
                        'username',
                        $employee->username
                    );
                    return redirect('/admin/d');
                } else {
                    return view('admin.login')->with([
                        'code' => '102',
                        'status' => 'Please wait while your confirmation is in process'
                    ]);
                }
            } else {
                return view('admin.login')->with([
                    'code' => '101',
                    'status' => 'Log In Failed, please check your password'
                ]);
            }
        }
        return view('admin.login')->with([
            'code' => '101',
            'status' => "Account doesn't exist, please register"
        ]);
    }

    public function logout()
    {
        Session::remove('username');
        return view('admin.login')->with([
            'status' => null,
        ]);
    }

    public function DashboardShow()
    {
        $username = Session::get('username');
        Session::reflash();
        if (isset($username) == true) {
            return view('admin.home')->with(['username' => $username]);
        } else {
            return view('admin.home')->with(['username' => 'Guest']);
        }
    }
}
