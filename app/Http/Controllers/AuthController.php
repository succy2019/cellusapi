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
        $str = substr($stro,0,10);

        $user = User::create([
            'user_id' => $str,
            'firstname' => $fields['firstname'],
            'lastname' => $fields['lastname'],
            'email' => $fields['email'],
            'phone' => $fields['phone']
        ]);
        // create user after validation
        // $message = "Welcome to Cellus your Opt Code is ". $stri;
        // $subject = "Account created successfully";
        // Mail::to($email)->send(new AccountCreated($message, $subject));
         $token = $user->createToken('register')->plainTextToken;

            //for Otp Code
        $number_array ='1234567890';
        $str =str_shuffle($number_array);
        $stri = substr($str,0,6);

        $opt = Otp::create([
            'user_id' => $user['user_id'],
            'otp_code' => $stri,
        ]);
   
        $response = [
            'userId' => $user['user_id'],
            'token' => $token
        ];
   
        // $message = "Welcome to Cellus your Opt Code is ". $stri;
        // $subject = "Account created successfully";
        // Mail::to($email)->send(new AccountCreated($message, $subject));

        return response($response, 201);
    }



    public function OtpAuth(Request $request)
    {
        $opt = $request->validate([
            'otpcode' => 'required'
        ]);

        $otp = Otp::where('otp_code', $opt['otpcode'])->first();
        if($otp)
        {
            $otp->otp_status =1;
            $otp->save();
            return response([
                'message' => 'Success',
            ], 200);
            
            $opt =$otp->otp_status;

        }if($opt =1)
        {
            return response([
                'message' => 'OTP HAS EXPIRED',
            ], 200);
        }
        else
        {
            return response([
                'message' => 'INCorrect Credentials',
            ], 404);

        }

    }

    public function ResendOtp(Request $request)
    {

    $fields = $request->validate([
        'email' => 'required'
    ]);
    $user =User::where('email', $fields['email'])->first();

    if($user)
    {
        $joint =DB::table('users')
        ->join('otps', 'otps.user_id', '=', 'users.user_id')
        ->get();
        $response = [
            'userId' => $joint['user_id'],
            'otpcode' => $joint['otp_code']
        ];
        // $message = "Welcome to Cellus your new otp Code is ". $joint['otp_code'];
        // $subject = "OTP RESEND CODE";
        // Mail::to($email)->send(new AccountCreated($message, $subject));

    }

    }


    public function login(Request $request)
    {
        $fields = $request->validate([
            // 'name' => 'required|string',
            'email' => 'required|string|email',
            
        ]);
        // validate user credentials gotten from form

        // check user email
        $user = User::where('email', $fields['email'])->first();

        // check password
        if (!$user) {
            return response([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $token = $user->createToken('login')->plainTextToken;

        $response = [
            // 'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }

    public function BvnVerify()
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
