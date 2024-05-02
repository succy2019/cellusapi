<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\TransactionResponse;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountCreated;
use App\Models\Addresses;
use App\Models\BuyCrypto;
use App\Models\Records;
use App\Models\Transactions;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use App\Mail\Notification;

class UserController extends Controller
{
    // 

    public function edit(Request $request, string $id)
    {

        $user = User::find($id);
        // $user->update($request->all());
        // print_r($user);
        // dd($user);



        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'mobile' => 'required',
            'address' => 'required'
        ]);

        $user->update($fields);
        $user = User::find($id);

        $response = [
            'user' => $user,
        ];

        // return response($response, 200);
        return $user;
    }

    public function changePassword(Request $request, string $id)
    {

        $fields = $request->validate([
            'old_password' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required'
        ]);

        $user = User::find($id);

        if (Hash::check($fields['old_password'], $user->password)) {

            if ($fields['password'] == $fields['password_confirmation']) {
                $password = ["password" => bcrypt($fields['password'])];
                $user->update($password);
                $user = User::find($id);
                return $user;
            } else {
                return response()->json([
                    'error' => "Passwords do not match"
                ], 400);
                // return $message = ["error", "Passwords do not match"];
            }
        } else {
            return response()->json([
                'error' => "Please provide your account password"
            ], 400);
        }
    }

    public function changePin(Request $request, string $id)
    {


        $user = User::find($id);
        $fields = $request->validate([
            'transaction_pin' => 'required',
        ]);
        $user->update($fields);
        $user = User::find($id);
        return $user;
    }


    public function verifyAddress(Request $request)
    {

        $fields = $request->all();
        $wall = $fields['wallet'];
        $post = [
            // "api_key" => '$2y$10$HshBGU5xnomTV3Z2zIrThOblnqwN.6E1a238XutA4tBgrWm1RapoC',
            "api_key" => env("COIN_REMITER_API_KEY"),
            "password" => env("COIN_REMITER_PASSWORD"),
            "address" => $request['wallet']
        ];

        // $ch = curl_init('http://www.example.com');
        $ch = curl_init('https://coinremitter.com/api/v3/' . $request['walletType'] . '/validate-address');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        // execute!
        $response = curl_exec($ch);

        // // close the connection, release resources used
        // curl_close($ch);

        // dd($request);
        return $response;
    }



    public function sendCrypto(Request $request)
    {

        $fields = $request->all();
        $wall = $fields['wallet'];
        $post = [
            // "api_key" => '$2y$10$HshBGU5xnomTV3Z2zIrThOblnqwN.6E1a238XutA4tBgrWm1RapoC',
            "api_key" => env("COIN_REMITER_API_KEY"),
            "password" => env("COIN_REMITER_PASSWORD"),
            "address" => $request['wallet'],
            "to_address" => $request['wallet'],
            "amount" => $request['amount'],
        ];

        $user = auth()->user();

        $transactions = [];
        $ch = curl_init('http://www.example.com');
        $ch = curl_init('https://coinremitter.com/api/v3/' . $request['walletType'] . '/withdraw');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

        // execute!
        $response = curl_exec($ch);

        // // close the connection, release resources used
        // curl_close($ch);

        // dd($request);
        // $transactions = $response['data'];

        $response_decode = json_decode($response);
        $transactions = (array) $response_decode->data;
        $transactions['user_id'] = $user['id'];
        $transactions['Tid'] = $transactions['id'];
        unset($transactions['id']);
        Transactions::create($transactions);
        // return $transactions;
        return $response;
    }


    // public function getUserWallet(Request $request)
    // {
    //     $fields = $request->all();
    //     $filter = ['user_id' => $fields['id'], "wallet_type" => $fields['type']];
    //     $filter = ['user_id' => $fields['id'], "wallet_type" => $fields['type']];
    //     $result = Addresses::where($filter)()->get();
    //     // $result = Addresses::where('user_id', '=', $fields['id'])->get();
    //     return $result;
    // }


    public function getUserWallet(string $id, string $type)
    {

        // dd($type);   
        // $fields = $request->all();
        // $filter = ['user_id' => $fields['id'], "wallet_type" => $fields['type']];
        $filter = ['user_id' => $id, "wallet_type" => $type];
        $result = Addresses::where($filter)()->get()->first();
        // $result = Addresses::where('user_id', '=', $fields['id'])->get();
        return $result;
    }



    public function getUserWallet2(string $id)
    {

        // dd($type);   
        // $fields = $request->all();
        // $filter = ['user_id' => $fields['id'], "wallet_type" => $fields['type']];
        $filter = ['user_id' => $id];
        // $result = Addresses::where("id", "=", $id)->get();
        $result = Addresses::where($filter)->get();
        // $result = Addresses::where('user_id', '=', $fields['id'])->get();
        return $result;
    }


    public function getUserWalletAddress(Request $request)
    {
        // $fields = $request->all();
        $user = auth()->user();
        // dd($user->id);
        // $filter = ['user_id' => $fields['id'], "wallet_type" => $fields['type']];
        $filter = ['user_id' => $user->id,];
        $result = Addresses::where($filter)->get();
        // $result = Addresses::where('user_id', '=', $fields['id'])->get();
        return $result;
    }


    public function getTransactions()
    {
        $user = auth()->user();
        $id = $user['id'];
        $filter = ['user_id' => $id];
        $response = Records::where($filter)->get();
        return $response;
    }


    public function buycrypto(Request $request)
    {
        // return $request->all();

        $type = $request['type'];
        $uid = $request['user_id'];





        $user = User::find($uid);
        $email = $user->email;

        BuyCrypto::create($request->all());


        $subject = "New $type Request ";
        $message = "A new Buy crypto request has been placed, Please login to process request";
        Mail::to("myzaneinnovate@gmail.com")->send(new Notification($message, $subject));


        return 1;
    }










    public function transcationResponse(Request $request)
    {

        // dd($request->all());
        // print_r(count($request->all()));
        // dd($request);
        $count = count($request->all());

        if ($count < 10) {
            return Response("here", 200);
        } else {
            $fields = $request->all();


            $response_type = $fields['type'];

            if ($response_type == "receive") {
                // get user_id
                $transaction_wallet = $fields['address'];
                $filterTransaction = ["wallet_address" => $transaction_wallet];
                $loca_transaction_data = Addresses::where($filterTransaction)->get()->first();
                // dd($loca_transaction_data);
                // // credit user account
                $user_id = $loca_transaction_data->user_id;
                $user = User::find($user_id)->first();
                $balance = $user->balance;
                $new_balance = $balance + $fields['amount'];
                $user->update(['balance' => $new_balance]);
                // create transaction record
                $record = [
                    'user_id' => $user_id,
                    'amount' => $fields['amount'],
                    'type' => 'credit',
                ];

                Records::create($record);
                TransactionResponse::create($request->all());
                return Response("", 200);

                // save transaction response
            } else {
                $transaction_id = $fields['txid'];
                $filterTransaction = ["txid" => $transaction_id];
                $loca_transaction_data = Transactions::where($filterTransaction)->get()->first();

                // debit user account
                $user_id = $loca_transaction_data->user_id;
                $user = User::find($user_id)->first();
                $balance = $user->balance;
                $new_balance = $balance - $fields['amount'];
                $user->update(['balance' => $new_balance]);



                // create transaction record
                $record = [
                    'user_id' => $user_id,
                    'amount' => $fields['amount'],
                    'type' => 'debit',
                ];

                Records::create($record);
                TransactionResponse::create($request->all());
                return Response("", 200);
            }
        }
    }

    public function postCheck(Request $request)
    {

        // dd($request);
        // print_r(count($request->all()));
        // dd($request);
        $count = count($request->all());

        if ($count < 10) {
            return Response("here", 200);
        } else {

            dd($request);


            TransactionResponse::create($request->all());
            return Response("", 200);
        }
    }


    public function createPaymentMethod(Request $request, int $id)
    {

        $fields = $request->validate([
            "bank_name" => "required",
            "account_name" => "required",
            "account_number" => "required",
        ]);

        $fields['user_id'] = $id;




        $method = PaymentMethod::create($fields);


        $user = User::find($id);

        $fields = [
            "payment_method" => "1"
        ];

        $user->update($fields);

        $response = [
            "status" => "201",
        ];

        return response($response, 200);
    }


    public function getUserMethods(int $id)
    {

        // $data = DB::table("payment_methods")->where("user_id", "=", $id)->get()->firstOrFail();
        $data = PaymentMethod::where("user_id", $id)->get()->firstOrFail();

        return response($data);
    }
}
