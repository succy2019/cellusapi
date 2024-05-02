<?php

use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\OptionsController;
use Illuminate\Support\Facades\Route;
use App\Models\Options;

use App\Mail\Notification;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');

    // $wallets = ["TCN", "BTC", "ETH", "LTC"];

    // foreach ($wallets as $key => $value) {
    //     echo $value;
    // }
});


Route::get("/admin", [Admincontroller::class, "index"]);
Route::get("/admin/login", [Admincontroller::class, "index"]);
Route::post("/admin/login", [Admincontroller::class, "login"]);


Route::get("/admin/register", [Admincontroller::class, "indexReg"])->middleware('admin');
Route::post("/admin/register", [Admincontroller::class, "store"])->middleware('admin');



Route::get("/admin/index", [Admincontroller::class, "home"])->middleware('admin');
Route::get("/admin/sell", [Admincontroller::class, "sell"])->middleware('admin');
Route::get("/admin/buy", [Admincontroller::class, "buy"])->middleware("admin");
Route::get("/admin/settings", [Admincontroller::class, "settings"])->middleware("admin");
Route::post("/admin/settings/updatepassword", [Admincontroller::class, "updatepassword"])->middleware("admin");
Route::get("/admin/view/buy/{id}/{uid}", [Admincontroller::class, "view_buy"])->middleware("admin");
Route::get("/admin/view/sell/{id}/{uid}", [Admincontroller::class, "view_sell"])->middleware("admin");

Route::get("admin/requeststatus/{type}/{status}/{id}", [Admincontroller::class, "handleRequest"])->middleware("admin");

Route::post("/admin/settings/updateoptions", [OptionsController::class, "update_options"])->middleware("admin");

Route::get("/rate", function () {
    // $ch = curl_init('https://v6.exchangerate-api.com/v6/cd3a9d89dce4624ac4296c8b/latest/USD');
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // $response = curl_exec($ch);
    // $data = (array) json_decode($response);
    // Session::put('dollar_rate', $data['conversion_rates']->NGN);
    // get set and buy added figures 


    $ch = curl_init('https://bitpay.com/api/rates');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    $dataz = (array) json_decode($res);
    // dd($dataz['2']);


    // print_r($dataz['2']);
    // print_r($dataz['117']);
    $dollar_rate = $dataz['2']->rate;
    $naira_rate = $dataz['117']->rate;
    $nTOD = $naira_rate / $dollar_rate;
    Session::put('dollar_rate', $nTOD);

    $values = Options::get();
    $responseDATA = [
        "buy" => $values[0]["buy"],
        "sell" => $values[0]["sell"],
        "dollar_to_naira_rate" => $nTOD,
        "dollar__rate" => $dataz["2"]
    ];

    // dd($responseDATA);
    return response($responseDATA);

    // return (json_encode($responseDATA));


});
Route::get("/rates", function () {
    // $ch = curl_init('https://v6.exchangerate-api.com/v6/cd3a9d89dce4624ac4296c8b/latest/USD');
    $ch = curl_init('https://bitpay.com/api/rates');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $data = (array) json_decode($response);
    // Session::put('dollar_rate', $data['conversion_rates']->NGN);
    dd($data);
    // get set and buy added figures 

    $values = Options::get();
    $responseDATA = [
        "buy" => $values[0]["buy"],
        "sell" => $values[0]["sell"],
        "dollar_rate" => $data["conversion_rates"]->NGN,
    ];

    dd($responseDATA);


});

Route::get('/secure/logout', [Admincontroller::class, 'logout'])->middleware('admin');


Route::get("/testmail", function () {
    $message = "Welcome to myzane";
    $subject = "Account created successfully";
    Mail::to("benossai7@gmail.com")->send(new Notification($message, $subject));
});
