<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Product;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Response;
use App\Models\Options;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Public routes
// Route::resource('products', ProductController::class);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products/search/{name}', [ProductController::class, 'search']);


//Auth Routes
Route::prefix('v1')->group(function()
{

Route::post("/register", [AuthController::class, 'register']);
Route::post("/login", [AuthController::class, 'login']);
Route::post("/otp", [AuthController::class, 'OtpAuth']);
Route::post("/sendotp", [AuthController::class, 'ResendOtp']);

});



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::middleware('auth:sanctum')->get('/products/search/{name}', [ProductController::class, 'search']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::resource('products', ProductController::class); 
    Route::post("/products", [ProductController::class, 'store']);
    Route::put("/products/{id}", [ProductController::class, 'update']);
    Route::delete("/products/{id}", [ProductController::class, 'destroy']);


    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get("/udata", [AuthController::class, 'getData']);
    // Route::get("/udata", [AuthController::class, 'getData']);

    Route::post("/user/edit/{id}", [UserController::class, 'edit']);
    Route::post("/user/change_password/{id}", [UserController::class, "changePassword"]);
    Route::post("/user/change_transactionpin/{id}", [UserController::class, "changePin"]);
    Route::post("/verify/address", [UserController::class, "verifyAddress"]);

    // Route::get("/getwallet/{id}/type/{type}" . [UserController::class], "getwallet");
    // Route::get("/getwallet/{id}/{wallet}", [UserController::class, "getUserWallet"]);
    Route::get("/getwallet/{id}/{wallet}", [UserController::class, "getUserWallet"]);
    Route::get("/getwallet/{id}", [UserController::class, "getUserWallet2"]);
    Route::get("/getUserWallets", [UserController::class, "getUserWalletAddress"]);
    Route::post("/sendCrypto", [UserController::class, "sendCrypto"]);
    Route::get("/getTransactions", [UserController::class, "getTransactions"]);
    Route::post("/user/create/payment/{id}", [UserController::class, 'createPaymentMethod']);

    Route::post("/buycrypto", [UserController::class, "buycrypto"]);
    Route::post("/sellcrypto", [UserController::class, "buycrypto"]);
});



Route::get("/getUserPaymentMethod/{id}", [UserController::class, "getUserMethods"]);







Route::get("/create_wallet", function () {
    // todo => modify this route to fit all required paraneters
    // set post fields
    $post = [
        "api_key" => '$2y$10$HshBGU5xnomTV3Z2zIrThOblnqwN.6E1a238XutA4tBgrWm1RapoC',
        "password" => "T3stZa1n3",
        "label" => "bt-wall"
    ];

    // $ch = curl_init('http://www.example.com');
    $ch = curl_init('https://coinremitter.com/api/v3/TCN/get-new-address');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

    // execute!
    $response = curl_exec($ch);
    $data = json_decode($response);
    // close the connection, release resources used
    // curl_close($ch);
    // print_r($response['data']);
    print_r($data);
    print_r($data->data->address);
    print_r($data->data->qr_code);
    // dd($response);
    // do anything you want with your response
    // var_dump($response);
});




Route::get("/validate_address", function () {
    // todo => modify this route to fit all required paraneters
    // set post fields
    $post = [
        "api_key" => '$2y$10$HshBGU5xnomTV3Z2zIrThOblnqwN.6E1a238XutA4tBgrWm1RapoC',
        "password" => "T3stZa1n3",
        "address" => "nr5LrBRZgDZnfANfW4pxF6yq1PsxX2qdYr2"
    ];

    // $ch = curl_init('http://www.example.com');
    $ch = curl_init('https://coinremitter.com/api/v3/TCN/validate-address');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

    // execute!
    $response = curl_exec($ch);

    // close the connection, release resources used
    curl_close($ch);

    dd($response);
    // do anything you want with your response
    // var_dump($response);
});



Route::get("/withdraw_api", function () {
    // todo => modify this route to fit all required paraneters
    // set post fields
    $post = [
        "api_key" => '$2y$10$HshBGU5xnomTV3Z2zIrThOblnqwN.6E1a238XutA4tBgrWm1RapoC',
        "password" => "T3stZa1n3",
        "to_address" => "nXcZas5dKM3cpwErQcv5bFtPwGJLgqE61V",
        "amount" => "2"
    ];

    // $ch = curl_init('http://www.example.com');
    $ch = curl_init('https://coinremitter.com/api/v3/TCN/withdraw');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

    // execute!
    $response = curl_exec($ch);

    // close the connection, release resources used
    curl_close($ch);

    dd($response);
    // do anything you want with your response
    // var_dump($response);
});


Route::get("/get_transaction_individual", function () {
    // todo => modify this route to fit all required paraneters
    // set post fields
    $post = [
        "api_key" => '$2y$10$HshBGU5xnomTV3Z2zIrThOblnqwN.6E1a238XutA4tBgrWm1RapoC',
        "password" => "T3stZa1n3",
        "address" => "nXcZas5dKM3cpwErQcv5bFtPwGJLgqE61V",
    ];

    // $ch = curl_init('http://www.example.com');
    $ch = curl_init('https://coinremitter.com/api/v3/TCN/get-transaction-by-address');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

    // execute!
    $response = curl_exec($ch);

    // close the connection, release resources used
    curl_close($ch);

    dd($response);
    // do anything you want with your response
    // var_dump($response);
});



Route::get("/t", function () {
    // todo => modify this route to fit all required paraneters
    $d = [
        "a" => "a",
        "b" => "b",
        "c" => [
            "c1" => "c1",
            "c2" => "c2"
        ]
    ];

    print_r($d["c"]['c1']);
});




Route::post("/web-hook", [UserController::class, "transcationResponse"]);

Route::post("/post_check", [UserController::class, "postCheck"]);


Route::get("/check", function () {
    echo "check";
    error_log('Some message here.');
});



Route::get("/rate", function () {
    $ch = curl_init('https://v6.exchangerate-api.com/v6/cd3a9d89dce4624ac4296c8b/latest/USD');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $data = (array) json_decode($response);
    Session::put('dollar_rate', $data['conversion_rates']->NGN);
    // get set and buy added figures 


    $ch = curl_init('https://bitpay.com/api/rates');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    $dataz = (array) json_decode($res);
    // dd($dataz['2']);

    $values = Options::get();
    $responseDATA = [
        "buy" => $values[0]["buy"],
        "sell" => $values[0]["sell"],
        "dollar_to_naira_rate" => $data["conversion_rates"]->NGN,
        "dollar__rate" => $dataz["2"]
    ];


    $d = json_encode($responseDATA);

    return response($d);

    // return (json_encode($responseDATA));


});