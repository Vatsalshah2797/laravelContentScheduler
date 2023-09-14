<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//use App\Http\Controllers\WalletController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/wallet/balance', [App\Http\Controllers\WalletController::class, 'getBalance']);
//Route::get('/wallet/balance', [App\Http\Controllers\WalletController::class, 'getBalance'])->name('wallet.balance');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/homepage', function () {
//     return view('dashboard');
// });
//Route::get('/payment', [App\Http\Controllers\PaymentController::class, 'viewPayment']);
//Route::get('/orderid-generate', [App\Http\Controllers\PaymentController::class, 'orderIdGenerate']);


//Route::get('/wallet', [App\Http\Controllers\WalletController::class, 'index']);
//Route::post('/wallet/add-money', [App\Http\Controllers\WalletController::class, 'addMoney'])->name('wallet.add-money');

//Route::post('/wallet/payment-callback', 'WalletController@paymentCallback')->name('wallet.payment-callback');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/wallet', [App\Http\Controllers\WalletController::class, 'index'])->name('wallet.index');
    Route::get('/wallet/add-money', [App\Http\Controllers\WalletController::class, 'addMoney'])->name('wallet.add-money');
});

// Route::get('/razorpay', [App\Http\Controllers\RazorpayController::class, 'razorpay'])->name('razorpay');
// Route::post('/razorpaypayment', [App\Http\Controllers\RazorpayController::class, 'payment'])->name('payment');
//Route::post('/payment', [App\Http\Controllers\PaymentController::class, 'storePayment']);


Route::middleware('auth')->group(function () {
    
    //Route::view('about', 'about')->name('about');
    //Old home
    //Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    //Dashboard
    Route::get('homepage', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('homepage');

    //Transaction History
    //Route::get('/payment', [App\Http\Controllers\PaymentController::class, 'viewPayment']);
    //Route::get('/orderid-generate', [App\Http\Controllers\PaymentController::class, 'orderIdGenerate']);
    //Route::post('/payment', [App\Http\Controllers\PaymentController::class, 'storePayment']);

    //Add money to wallet 
    Route::post('razorpay-payment',[App\Http\Controllers\RazorpayController::class,'store'])->name('razorpay.payment.store');


    //Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    //Route::resource('users', \App\Http\Controllers\UserController::class);
    //My Profile and change password
    //Route::get('profile', [App\Http\Controllers\HomeController::class, 'myProfile'])->name('profile');
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::resource('customers', \App\Http\Controllers\CustomerController::class);
    Route::resource('contents', \App\Http\Controllers\ContentController::class);
    Route::resource('transactions', \App\Http\Controllers\WalletTransactionController::class);
});
