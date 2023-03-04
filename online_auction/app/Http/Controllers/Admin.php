<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Employee;
use App\Models\Item;
use App\Models\RunningOffer;
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
                    Session::flash(
                        'level',
                        $employee->level
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
        Session::remove('level');
        return view('admin.login')->with([
            'status' => null,
        ]);
    }

    public function DashboardShow()
    {
        $username = Session::get('username');
        $level = Session::get('level');
        Session::reflash();
        if (isset($username) == true) {
            return view('admin.home')->with(['username' => $username, 'level' => $level]);
        } else {
            return redirect('/admin');
        }
    }
    
    public function ItemShow(){
        $username = Session::get('username');
        $level = Session::get('level');
        $items = Item::all();
        Session::reflash();
        if (isset($username) == true && isset($level) == true) {
            return view('admin.items')->with([
                'username' => $username, 
                'level' => $level, 
                'items' => $items
            ]);
        } else {
            return redirect('/admin/d');
        }
    }

    public function SingleItemShow($item_id)
    {
        Session::reflash();
        $username = Session::get('username');
        $level = Session::get('level');
        $auction = Auction::all()->where('item_id', $item_id);
        $item = Item::all()->where('item_id', $item_id);
        $auction_data = [];
        $user_data = [];
        $offer = [];

        foreach ($auction as $a) {
            $auction_data = $a;
        }
        $auction_id = $auction_data->auction_id;
        $running_offer = RunningOffer::all()->where('auction_id', $auction_id);
        foreach ($running_offer as $r) {
            $offer = $r;
        }
        $user = User::all()->where('username', $username);
        foreach ($user as $user) {
            $user_data = $user;
        }
        if (isset($username) == true && isset($level) == true) {
            Session::reflash();
            // dd($auction);
            return view('admin.item', [
                'offer' => $offer,
                'item' => $item,
                'auction' => $auction_data,
                'username' => $username,
                'level' => $level,
                'user' => $user_data,
                'status' =>  ''
            ]);
        } else {
            return redirect('/admin/d');
        }
    }

    public function DeleteSubject(Request $request, $subject_name, $subject_id){
        switch ($subject_name) {
            case 'item':
                Session::reflash();
                echo "<script>alert('Your action is irrevirsible')</script>";
                Item::where('item_id', '=', $subject_id)->delete();
                return redirect('/admin/item');
            case 'auction':
                // dd("Deleting Auction");
                break;
            
            case 'user':
                // dd("Deleting User");
                break;
            
            case 'employee':
                // dd("Deleting Employee");
                break;
        }
    }
}
