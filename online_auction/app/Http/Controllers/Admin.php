<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\AuctionHistory;
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

    private function updateLevel($username){
        $employee_data = Employee::all()->where('username', '=', $username);
        foreach($employee_data as $e){
            $employee_data = $e;
        }
        $level = $employee_data->level;
        Session::flash('level', $level);
    }
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

        date_default_timezone_set($request->timezone);

                Session::flash('tz', $request->timezone);

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
        try {
            Admin::updateLevel($username);
        } catch (\Throwable $th) {
            return redirect('/admin');
        }
        $level = Session::get('level');
        Session::reflash();
        if (!isset($level)) {
            return redirect('/login');
        } else {
            return view('admin.home')->with(['username' => $username, 'level' => $level]);
        }
    }

    public function ItemShow()
    {
        $username = Session::get('username');
        try {
            Admin::updateLevel($username);
        } catch (\Throwable $th) {
            return redirect('/admin');
        }
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
        try {
            Admin::updateLevel($username);
        } catch (\Throwable $th) {
            return redirect('/admin');
        }
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
        try {
            Admin::updateLevel($username);
        } catch (\Throwable $th) {
            return redirect('/admin');
        }
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
        $code = Session::get('code');
        $message = Session::get('message');
        try {
            Admin::updateLevel($username);
        } catch (\Throwable $th) {
            return redirect('/admin');
        }
        $level = Session::get('level');
        $auctions = DB::select(
        "SELECT auctions.auction_id, auctions.status, items.item_id, items.item_name, items.image,auctions.auction_date, auctions.starting_price, items.initial_price
        FROM auctions
        INNER JOIN items
        ON auctions.item_id = items.item_id");
        $items = DB::select(
            "SELECT * FROM items WHERE item_id NOT IN (SELECT item_id FROM auctions)"
        );

        Session::reflash();
        if (isset($username) == true && isset($level) == true) {
            return view('admin.auctions')->with([
                'username' => $username,
                'level' => $level,
                'auctions' => $auctions,
                'items' => $items,
                'code' => $code,
                'message' => $message
            ]);
        } else {
            return redirect('/admin/d');
        }
    }
    public function ReportsShow()
    {
        $username = Session::get('username');
        try {
            Admin::updateLevel($username);
        } catch (\Throwable $th) {
            return redirect('/admin');
        }
        $level = Session::get('level');
        $auctions = DB::select(
        "SELECT auctions.auction_id, auctions.status, items.item_id, items.item_name, items.image,auctions.auction_date, auctions.starting_price, items.initial_price
        FROM auctions
        INNER JOIN items
        ON auctions.item_id = items.item_id
        WHERE auctions.status = 1
        ");
        $items = DB::select(
            "SELECT * FROM items WHERE item_id NOT IN (SELECT item_id FROM auctions)"
        );

        Session::reflash();
        if (isset($username) == true && isset($level) == true) {
            return view('admin.reports')->with([
                'username' => $username,
                'level' => $level,
                'auctions' => $auctions,
                'items' => $items
            ]);
        } else {
            return redirect('/admin/d');
        }
    }

    public function ReportPrint($auction_id){
        $username = Session::get('username');
        try {
            Admin::updateLevel($username);
        } catch (\Throwable $th) {
            return redirect('/admin');
        }
        $level = Session::get('level');
        $auction_raw = Auction::all()->where('auctionid', '=', $auction_id);

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
                $price_fix = str_replace( ',', '', $request->initial_price );
                $item_data = [
                    'item_name' => $request->item_name,
                    'input_date' => $request->input_date,
                    'image' => "/assets/" . $image,
                    'company_name' => $request->company_name,
                    'location' => $request->location,
                    'initial_price' => $price_fix,
                    'description' => $request->description,
                ];
                $item_validation = $request->validate([
                    'input_date' => 'date',
                    'image' => 'mimes:png,PNG,jpg,JPG,jpeg,JPEG,webp,WEBP',
                    'description' => 'max:300',
                ]);
                $request->image->move(public_path('assets'), $image);
                Item::create($item_data);
                return redirect('/admin/item');
                break;
                
            case 'auction':
                $employee_data = Employee::all()->where('employee_name', '=', $request->employee_name);
                foreach($employee_data as $e){
                    $employee_data = $e;
                };

                $item_data = Item::all()->where('item_id', '=', $request->item_id);
                foreach($item_data as $i){
                    $item_data = $i;
                }
                date_default_timezone_set($request->timezone);

                Session::flash('tz', $request->timezone);
                $date = date('Y-m-d');

                $auction_data = [
                    'item_id' => $request->item_id,
                    'employee_id' => $employee_data->employee_id,
                    'auction_date' => $date,
                    'starting_price' => $item_data->initial_price,
                    'status' => $request->status,
                ];

                Auction::create($auction_data);

                return redirect('/admin/auction');
                break;

            case 'user':
                
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
                $employee_validation = $request->validate([
                    'employee_name' => 'required|unique:employees,employee_name',
                    'username' => 'required|unique:employees,username',
                    'password' => 'required',
                    'level' => 'required',
                ]);
                Employee::create($employee_validation);
                return redirect('/admin/employee');
                break;
        }
    }

    public function DeleteSubject($subject_name, $subject_id)
    {
        Session::reflash();
        $username = Session::get('username');
        try {
            Admin::updateLevel($username);
        } catch (\Throwable $th) {
            return redirect('/admin');
        }
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
        try {
            Admin::updateLevel($username);
        } catch (\Throwable $th) {
            return redirect('/admin');
        }
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
                return redirect('admin');
                break;

            case 'employee':
                $employee = Employee::all()->where('employee_id', '=', $subject_id);
                return view('admin.edit_employee', [
                    'employee' => $employee,
                    'username' => $username,
                    'level' => $level,
                ]);
                break;
        }
    }

    public function UpdateSubject(Request $request, $subject_name, $subject_id)
    {
        Session::reflash();
        $username = Session::get('username');
        try {
            Admin::updateLevel($username);
        } catch (\Throwable $th) {
            return redirect('/admin');
        }
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
            case 'employee':
                $employee_data = [
                    "username"=>$request->username,
                    "employee_name" => $request->employee_name,
                    "password" =>$request->password,
                    "level"=>$request->level
                ];
                Employee::where('employee_id','=', $subject_id)->update($employee_data);
                $employee_data = Employee::all()->where('employee_id', '=', $subject_id);
                foreach($employee_data as $e){
                    $employee_data = $e;
                };
                if($employee_data->level == 1){
                    Session::flash('level', 1);
                    return redirect('/admin');
                } else{
                    return redirect('/admin/employee');

                }
                break;
        }
    }

    public function SetStatusAs($auction_id, $status){
        Session::reflash();
        $username = Session::get('username');
        $level = Session::get('level');
        try {
            Admin::updateLevel($username);
        } catch (\Throwable $th) {
            return redirect('/admin');
        }

        $auction = [];
        $offer = [];

        $auction_raw = Auction::all()->where('auction_id', '=', $auction_id);
        $offer_raw = RunningOffer::all()->where('auction_id', '=', $auction_id);
        foreach($auction_raw as $i){
            $auction = $i;
        }

        foreach($offer_raw as $i){
            $offer = $i;
        }

        try {
            $user_id = $offer->user_id;
        } catch (\Throwable $th) {
            Session::flash('code', '101');
            Session::flash('message', 'Lelang ini belum diisi oleh penawar, tidak dapat diselesaikan');
            return redirect('/admin/auction');
        }

        date_default_timezone_set(Session::get('tz'));
        $date = date('Y-m-d');

        if(isEmpty($offer_raw)){
            $offer = $auction->starting_price;
        } else {
            $offer = [
                'user_id' => $offer->user_id,
                'offer_price' => $offer->offer_price];
        }

        if($status = 1){
            $status_data = [
                "status" => $status
            ];

            $history_data = [
                'auction_id' => $auction_id,
                'item_id' => $auction->item_id,
                'user_id' => $offer->user_id,
                'report_date' => $date,
                'sold_price' => $offer->offer_price
            ];
            Auction::where('auction_id', '=', $auction_id)->update($status_data);
            AuctionHistory::create($history_data);
        } else{   
            $status_data =  [
                "status" => $status
            ];
            Auction::where('auction_id', '=', $auction_id)->update($status_data);
        }
            return redirect('/admin/auction');

    }

    public function SaveAsHistory($auction_id){
        Session::reflash();
        $username = Session::get('username');
        $level = Session::get('level');
        try {
            Admin::updateLevel($username);
        } catch (\Throwable $th) {
            return redirect('/admin');
        }
    }
}
