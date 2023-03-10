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
        $item = Item::all()->where('item_id', $item_id);
        $user_data = [];
        $user = User::all()->where('username', $username);
        foreach ($user as $user) {
            $user_data = $user;
        }
        if (isset($username) == true && isset($level) == true) {
            Session::reflash();
            // dd($auction);
            return view('admin.item', [
                'item' => $item,
                'username' => $username,
                'level' => $level,
                'user' => $user_data,
                'status' =>  ''
            ]);
        } else {
            return redirect('/admin/d');
        }
    }

    public function SubjectAdd(Request $request, $subject_name)
    {
        Session::reflash();
        switch ($subject_name) {
            case 'item':
                Session::reflash();
                Session::remove('errors');
                if (isset($request->image)) {
                    $image = $request->image->getClientOriginalName();
                } else {
                    $image = 'logo-dark.png';
                }
                $item_data = [
                    'item_name' => $request->item_name,
                    'input_date' => $request->input_date,
                    'image' => "/assets/" . $image,
                    'company_name' => $request->company_name,
                    'location' => $request->location,
                    'initial_price' => $request->initial_price,
                    'description' => $request->description,
                ];
                $item_validation = $request->validate([
                    'input_date' => 'date',
                    'image' => 'mimes:png,PNG,jpg,JPG,jpeg,JPEG,webp,WEBP',
                    'initial_price' => 'numeric',
                    'description' => 'max:300',
                ]);
                $request->image->move(public_path('assets'), $image);
                Item::create($item_data);
                return redirect('/admin/item');
                break;
            case 'auction':
                echo "<script>alert('Your action is irrevirsible')</script>";

                return redirect('/admin/auction');
                break;

            case 'user':
                // dd($request);
                $user_validation = $request->validate([
                    'full_name' => 'required',
                    'username' => 'required|unique:users,username',
                    'password' => 'required',
                    'telephone' => 'required'
                ]);
                User::create($user_validation);
                return redirect('/admin/user');
                break;

            case 'employee':
                echo "<script>alert('Your action is irrevirsible')</script>";

                return redirect('/admin/employee');
                break;
        }
    }

    public function DeleteSubject($subject_name, $subject_id)
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

    public function EditShow($subject_name, $subject_id)
    {
        Session::reflash();
        $username = Session::get('username');
        $level = Session::get('level');
        switch ($subject_name) {
            case 'item':
                $mydate = getdate(date("U"));
                $item = Item::all()->where('item_id', '=', $subject_id);
                return view('admin.edit_item', [
                    'item' => $item,
                    'username' => $username,
                    'level' => $level,
                    'mydate' => $mydate
                ]);
                break;
            case 'auction':
                echo "<script>alert('Your action is irrevirsible')</script>";
                break;

            case 'user':
                $mydate = getdate(date("U"));
                $user = User::all()->where('user_id', '=', $subject_id);
                return view('admin.edit_user', [
                    'user' => $user,
                    'username' => $username,
                    'level' => $level
                ]);
                break;

            case 'employee':
                echo "<script>alert('Your action is irrevirsible')</script>";
                break;
        }
    }

    public function UpdateSubject(Request $request, $subject_name, $subject_id)
    {
        Session::reflash();
        $username = Session::get('username');
        $level = Session::get('level');
        switch ($subject_name) {
            case 'item':
                $item = Item::all()->where('item_id', '=', $subject_id);
                $item_data = [];
                foreach ($item as $item) {
                    $item_data = $item;
                };
                if (isset($request->image)) {
                    $image = "/assets/" . $request->image->getClientOriginalName();
                } else {
                    $image = $item_data->image;
                }
                $item_data = [
                    'item_name' => $request->item_name,
                    'input_date' => $request->input_date,
                    'image' => $image,
                    'company_name' => $request->company_name,
                    'location' => $request->location,
                    'initial_price' => $request->initial_price,
                    'description' => $request->description,
                ];
                $item_validation = $request->validate([
                    'input_date' => 'date',
                    'image' => 'mimes:png,PNG,jpg,JPG,jpeg,JPEG,webp,WEBP',
                    'initial_price' => 'numeric',
                    'description' => 'max:300',
                ]);
                try {
                    $request->image->move(public_path('assets'), $image);
                    Item::where('item_id', '=', $subject_id)->update($item_data);
                    return redirect('/admin/item');
                } catch (\Throwable $th) {
                    Item::where('item_id', '=', $subject_id)->update($item_data);
                    return redirect('/admin/item');
                }
                break;
            case 'auction':
                echo "<script>alert('Your action is irrevirsible')</script>";
                break;

            case 'user':
                echo "<script>alert('Your action is irrevirsible')</script>";
                break;

            case 'employee':
                echo "<script>alert('Your action is irrevirsible')</script>";
                break;
        }
    }
}
