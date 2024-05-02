<?php

namespace App\Http\Controllers;

use App\Mail\AccountCreated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Addresses;
use App\Models\Otp;

class AuthController extends Controller
{

    public function createBank()
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.paystack.co/dedicated_account/assign",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_SSL_VERIFYPEER => true,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => array(
            "email" => "janedoe@test.com",
            "first_name" => "Jane",
            "middle_name" => "Karen",
            "last_name" => "Doe",
            "phone" => "+2348100000000",
            "preferred_bank" => "test-bank",
            "country" => "NG"
          ),
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer sk_test_2ca5680ff6321c91957f65978c7bc349ba8da424",
            "Content-Type: application/json"
          ),
        ));
        
        $response = curl_exec($curl);
        $da = json_decode($response);
        curl_close($curl);
         return $da;
    }

    public function createWallet($type)
    {

        $post = [
            // "api_key" => '$2y$10$QI0BWshZNmft9d99UhndcuSo0Fk8.ytu01UZc0XVvC8MXi9j12jZ.',
            // "password" => "cellus",
            "api_key" => env("COIN_REMITER_API_KEY"),
            "password" => env("COIN_REMITER_PASSWORD"),
            "label" => "bt-wall"
        ];

        // $ch = curl_init('http://www.example.com');
        $ch = curl_init("https://coinremitter.com/api/v3/$type/get-new-address");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        // execute!
        $response = curl_exec($ch);

        // close the connection, release resources used
        curl_close($ch);

        // dd($response);
        $data = json_decode($response);
        return $data;
    }

    public function register(Request $request)
    {

        $fields = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|unique:users,email|email',
            'phone' => 'required|string'
          
        ]);
        // validate user credentials gotten from form
        $email = $fields['email'];

        $stray ='qwertyuiopasdfghjklzxcvbnm';
        $stro =str_shuffle($stray);
        $stri = substr($stro,0,18);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'mobile' => $fields['phone'],
            'idtoken' => $stri,
            'password' => bcrypt($fields['password'])
        ]);
        // create user after validation
        // $message = "Welcome to Cellus";
        // $subject = "Account created successfully";
        // Mail::to($email)->send(new AccountCreated($message, $subject));
        // $token = $user->createToken('myapptoken')->plainTextToken;

            //for Otp Code
        $number_array ='1234567890';
        $str =str_shuffle($number_array);
        $stri = substr($str,0,6);

        $opt = Otp::create([
            'user_id' => $user['idtoken'],
            'otpcode' => $stri,
        ]);

        $bank = $this->createBank();
        
        $wallets = ["BTC", "ETH", "LTC"];

        // foreach ($wallets as $key => $value) {

        // $wallet = $this->createWallet("BTC");
        // $wallet = $this->createWallet($value);

        // $wallet_data = [
        //     "wallet_address" => $wallet->data->address,
        //     "wallet_type" => "BTC",
        //     "user_id" => $user['id'],
        //     "qr_code" => $wallet->data->qr_code
        // ];
        // Addresses::create($wallet_data);
        // }


        // print_r($wallet);
        $response = [
            'user' => $user,
            'bank' => $bank,
            'otp' => $opt['otpcode']
        ];

        return response($response, 201);
    }


    public function login(Request $request)
    {
        $fields = $request->validate([
            // 'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        // validate user credentials gotten from form

        // check user email
        $user = User::where('email', $fields['email'])->first();

        // check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $user['idtoken']
        ];

        return response($response, 200);
    }

    public function responseHandler()
    {
    }


    public function logout(Request $request)
    {
        // auth()->user()->tokens()->delete();
        auth()->user()->currentAccessToken()->delete();
        // 
        return [
            'message' => 'Logged out'
        ];
    }

    public function getData(Request $request)
    {
        $user = auth()->user();
        return response(['user' => $user], 200);
    }
}
