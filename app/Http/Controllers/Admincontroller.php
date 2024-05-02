<?php

namespace App\Http\Controllers;

use App\Models\Records;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\BuyCrypto;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;
use Session;
use App\Models\Options;
use App\Mail\Notification;
use Illuminate\Support\Facades\Mail;

class Admincontroller extends Controller
{
    //

    public function index()
    {
        // echo "hello";
        return view('adminauth.login');
    }

    public function login(Request $request)
    {


        // dd($request->all());

        $admin = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->guard('admin')->attempt($admin)) {
            $admin_user = auth()->guard('admin')->user();

            if ($admin_user->is_admin == 1) {

                $ch = curl_init('https://v6.exchangerate-api.com/v6/cd3a9d89dce4624ac4296c8b/latest/USD');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                $data = (array) json_decode($response);
                // dd($data);
                Session::put('dollar_rate', $data['conversion_rates']->NGN);


                return redirect('/admin/index', )->with('message', 'Welcome Back');
            } else {
                return redirect('/admin/login', )->with('error', 'Incorrect credentials');
            }
        } else {
            return redirect('/admin/login', )->with('error', 'Incorrect credentials');
        }
    }

    public function indexReg()
    {
        return view("adminauth.register");
    }

    public function store(Request $request)
    {
        // dd($request->all());



        $fields = $request->validate([
            'full_name' => 'required',
            'email' => 'email|required|string|unique:admin',
            'mobile_number' => 'required|string|unique:admin',
            'password' => 'required|string|confirmed'
        ]);

        $fields['password'] = bcrypt($fields['password']);
        $admin = Admin::create($fields);
        Auth::guard('admin')->login($admin);
        return redirect('/admin/index', )->with('message', 'Welcome Back');
    }

    public function home()
    {

        $users = User::all()->toQuery()->paginate(15);
        $usersCOunt = User::all()->count();
        $values = Options::get();
        // dd($values);
        return view("admin.index", ['users' => $users, 'values' => $values, "count" => $usersCOunt]);
        // return view('admin.index');
    }




    public function settings()
    {

        $users = User::all()->toQuery()->paginate(15);
        return view("admin.settings");
    }


    public function updatepassword(Request $request)
    {

        // dd($request->all());
        $rules = [
            'current_password' => 'required',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required',
        ];

        $custom_message = [
            'confirmed' => 'Passwords do not match'
        ];

        $fields = $this->validate($request, $rules, $custom_message);

        $admin = auth("admin")->user();
        // print_r($admin);
        // dd($fields);

        // check if password match
        if (Hash::check($fields['current_password'], $admin->password)) {
            // check if new password match old password 
            if (Hash::check($fields['password'], $admin->password)) {
                return redirect('/admin/settings')->with('error', 'Your new password can not be the same as your old password.');
            } else {
                // update user account password
                $password = bcrypt($fields['password']);

                // echo "no match";
                $data = Admin::find($admin->id);
                $data->update(["password" => $password]);
                return redirect('/admin/settings')->with('message', 'Password changed successfully.');
            }
        } else {
            return redirect('/admin/settings')->with('error', 'Please input your account password.');
        }
    }



    public function sell()
    {

        $data = DB::table("users")->join('buy_cryptos', function (JoinClause $join) {
            $join->on('users.id', '=', 'buy_cryptos.user_id')
                ->where('buy_cryptos.type', '=', "Sell")->where("status", '=', 0);
        })->paginate(15);

        // dd($data);

        return view('admin.sell', [
            "users" => $data
        ]);
        // return view('admin.index');
    }









    public function buy()
    {

        // $data = BuyCrypto::all()->toQuery()->paginate(15);
        // $users = User::all()->where()

        // $data = DB::table("users")->join("buy_cryptos", "users.id", "=", "buy_cryptos.user_id")->select("users.*", "buy_cryptos.*")->paginate(2);


        $data = DB::table("users")->join('buy_cryptos', function (JoinClause $join) {
            $join->on('users.id', '=', 'buy_cryptos.user_id')
                ->where('buy_cryptos.type', '=', "Buy")->where("status", '=', 0);
        })->paginate(15);

        // dd($data);

        return view('admin.buy', [
            "users" => $data
        ]);
    }

    public function view_buy(int $id, int $uid)
    {

        // $data = BuyCrypto::where("id", "=", $id, "and", "user_id", "=", $uid);
        $data = DB::table("buy_cryptos")->where("id", "=", $id)->where("user_id", "=", $uid)->get()->firstOrFail();
        $user = DB::table("users")->where("id", "=", $uid)->get()->firstOrFail();

        return view("admin.view_buy_request", [
            "user" => $user,
            "data" => $data
        ]);
    }
    public function view_sell(int $id, int $uid)
    {

        // $data = BuyCrypto::where("id", "=", $id, "and", "user_id", "=", $uid);
        $data = DB::table("buy_cryptos")->where("id", "=", $id)->where("user_id", "=", $uid)->get()->firstOrFail();
        $user = DB::table("users")->where("id", "=", $uid)->get()->firstOrFail();
        $payment_method = DB::table("payment_methods")->where("user_id", "=", $uid)->get()->first();

        return view("admin.view_sell_request", [
            "user" => $user,
            "data" => $data,
            "payment_method" => $payment_method
        ]);
    }




    public function handleRequest(string $type, int $status, int $id)
    {
        // type 1 == buy request,  type 2 == sell request
        // status 1 == approve, status == dcline/reject
        // print_r($id);

        $data = BuyCrypto::find($id);
        // dd($data['amount']);
        $amount = $data['amount'];
        $uid = $data['user_id'];

        $user = User::find($uid);
        $balance = $user->balance;
        $email = $user->email;

        if ($type == 1) {
            $balance = $balance + $amount;
        } else {
            $balance = $balance - $amount;
        }

        // echo $balance;
        // dd($user);

        // $data->update(["status" => $status]);
        if ($status == 1) {
            $user->update(['balance' => $balance]);

            if ($type == 1) {
                $record = [
                    'user_id' => $uid,
                    'amount' => $amount,
                    'type' => 'Buy',
                ];

                Records::create($record);

                $subject = "P2P request Processed";
                $message = "You p2p buy request of $$amount had been processed sucessfully.";
                Mail::to($email)->send(new Notification($message, $subject));


                return redirect('/admin/buy')->with('message', 'Buy request has been approved successfully.');
            } else {
                $record = [
                    'user_id' => $uid,
                    'amount' => $amount,
                    'type' => 'Sell',
                ];

                Records::create($record);

                $subject = "P2P request Processed";
                $message = "You p2p sell order of $$amount had been processed sucessfully.";
                Mail::to($email)->send(new Notification($message, $subject));

                return redirect('/admin/sell')->with('message', 'Sell request has been approved successfully.');
            }
        } else {
            if ($type == 1) {
                return redirect('/admin/buy')->with('error', 'Buy request has been declined successfully.');
            } else {
                return redirect('/admin/sell')->with('error', 'Sell request has been declined successfully.');
            }
        }

    }











    function logout(Request $request)
    {
        // dd($request->all());

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}
