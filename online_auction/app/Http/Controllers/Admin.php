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
use Illuminate\Support\Facades\DB;
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
            return redirect('/admin/d');
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

    public function ItemShow()
    {
        $username = Session::get('username');
        $level = Session::get('level');
        $items = Item::all();
        $mydate = getdate(date("U"));
        Session::reflash();
        if (isset($username) == true && isset($level) == true) {
            return view('admin.items')->with([
                'username' => $username,
                'level' => $level,
                'items' => $items,
                'mydate' => $mydate
            ]);
        } else {
            return redirect('/admin/d');
        }
    }

    public function UserShow()
    {
        $username = Session::get('username');
        $level = Session::get('level');
        $users = User::all();
        Session::reflash();
        if (isset($username) == true && isset($level) == true) {
            return view('admin.users')->with([
                'username' => $username,
                'level' => $level,
                'users' => $users
            ]);
        } else {
            return redirect('/admin/d');
        }
    }

    public function EmployeeShow()
    {
        $username = Session::get('username');
        $level = Session::get('level');
        $employees = Employee::all();
        Session::reflash();
        if (isset($username) == true && isset($level) == true) {
            return view('admin.employees')->with([
                'username' => $username,
                'level' => $level,
                'employees' => $employees
            ]);
        } else {
            return redirect('/admin/d');
        }
    }

    public function AuctionShow()
    {
        $username = Session::get('username');
        $level = Session::get('level');
        $auctions = DB::select("SELECT auctions.auction_id, items.item_name, items.image,auctions.auction_date, auctions.starting_price, items.initial_price
        FROM auctions
        INNER JOIN items
        ON auctions.item_id = items.item_id");
        Session::reflash();
        if (isset($username) == true && isset($level) == true) {
            return view('admin.auctions')->with([
                'username' => $username,
                'level' => $level,
                'auctions' => $auctions
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

    public function SubjectAdd(Request $request, $subject_name, $subject_id)
    {
        Session::reflash();
        switch ($subject_name) {
            case 'item':
                echo "<script>alert('Your action is irrevirsible')</script>";
                $user_data = $request->validate([
                    'item_name' => 'required',
                    'input_date' => 'date',
                    'company_name' => 'required',
                    'location' => 'required',
                    'initial_price' => 'required|numeric',
                    'description' => 'required|max:300',
                ]);
                Item::create();
                return redirect('/admin/item');
                break;

            case 'auction':
                echo "<script>alert('Your action is irrevirsible')</script>";

                return redirect('/admin/auction');
                break;

            case 'user':
                echo "<script>alert('Your action is irrevirsible')</script>";

                return redirect('/admin/user');
                break;

            case 'employee':
                echo "<script>alert('Your action is irrevirsible')</script>";

                return redirect('/admin/employee');
                break;
        }
    }

    public function DeleteSubject(Request $request, $subject_name, $subject_id)
    {
        Session::reflash();
        switch ($subject_name) {
            case 'item':
                echo "<script>alert('Your action is irrevirsible')</script>";
                Item::where('item_id', '=', $subject_id)->delete();
                return redirect('/admin/item');
                break;
            case 'auction':
                echo "<script>alert('Your action is irrevirsible')</script>";
                Auction::where('auction_id', '=', $subject_id)->delete();
                return redirect('/admin/auction');
                break;

            case 'user':
                echo "<script>alert('Your action is irrevirsible')</script>";
                User::where('user_id', '=', $subject_id)->delete();
                return redirect('/admin/user');
                break;

            case 'employee':
                echo "<script>alert('Your action is irrevirsible')</script>";
                Employee::where('employee_id', '=', $subject_id)->delete();
                return redirect('/admin/employee');
                break;
        }
    }
}
