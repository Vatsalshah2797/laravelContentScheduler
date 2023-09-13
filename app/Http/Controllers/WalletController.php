<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class WalletController extends Controller
{
    //
    public function getBalance(Request $request)
    {
        //echo "hello";
        //echo config('services.razorpay.key'); 
        //echo config('services.razorpay.secret');
        //exit;
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        // $customer = $api->customer->create([
        //     'name' => 'John Doe', // Replace with the customer's name
        //     'email' => 'john@example.com', // Replace with the customer's email
        //     // Add any other relevant customer details
        // ]);
        
        // Store the customer ID in your database for future reference
        //$customerId = $customer->id;
        $customerId = "cust_MaSD20KAwS9Loq";
        //dd($api);
        // Replace 'customer_id' with the actual customer ID associated with the user
        //$customerId = 'MaJK9gMyPfrG10';
        //echo $customerId;
        try {
            // Fetch the customer's balance
            $customer = $api->customer->fetch($customerId);
            dd($customer);
            // Get the current balance
            $balance = $customer->balance;
            dd($balance);

            return view('wallet.balance', ['balance' => $balance]);
        } catch (\Exception $e) {
            print_r($e->getMessage());exit;
            return back()->with('error', 'Failed to fetch wallet balance.');
        }
    }

    // public function index()
    // {
    //     // Implement logic to display wallet balances or form to add balance
    // }

    // public function addMoney(Request $request)
    // {
    //     $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

    //     // Implement logic to calculate the amount to add to the wallet
    //     $amountToAdd = 1000; // Change this according to your requirements

    //     // Create an order in Razorpay
    //     $order = $api->order->create([
    //         'amount' => $amountToAdd * 100, // Amount in paise
    //         'currency' => 'INR', // Change currency as needed
    //         'payment_capture' => 1,
    //     ]);

    //     // Implement logic to store the order ID in your database for reference

    //     // Redirect the user to the Razorpay payment page
    //     return redirect($order->short_url);
    // }

    // public function paymentCallback(Request $request)
    // {
    //     // Implement logic to handle the Razorpay payment callback
    //     $paymentId = $request->input('razorpay_payment_id');
    //     $orderId = $request->input('razorpay_order_id');
    //     $signature = $request->input('razorpay_signature');

    //     // Verify the payment signature using Razorpay API
    //     $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
    //     $attributes = [
    //         'razorpay_order_id' => $orderId,
    //         'razorpay_payment_id' => $paymentId,
    //         'razorpay_signature' => $signature,
    //     ];

    //     try {
    //         $api->utility->verifyPaymentSignature($attributes);
    //         // Payment is successful, update the user's wallet balance
    //         // Implement wallet balance update logic here

    //         return view('wallet.success');
    //     } catch (\Exception $e) {
    //         // Payment failed, handle the error
    //         return view('wallet.failure')->with('error', $e->getMessage());
    //     }
    // }

    public function index()
    {
        $user = auth()->user();
        //dd($user);
        $wallet = $user->wallet;
        dd($wallet);

        return view('wallet.index', compact('user', 'wallet'));
    }

    public function addMoney(Request $request)
    {
        $user = auth()->user();
        //$amountToAdd = $request->input('amount');
        $amountToAdd = 100;
        $userBalance = $amountToAdd;
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $order = $api->order->create([
            'amount' => $amountToAdd * 100, // Amount in paise
            'currency' => 'INR', // Change currency as needed
            'payment_capture' => 1,
        ]);

        // Implement logic to store the order ID and user ID in your database
        $currentUserWalletInfo = $this->getUserBalance($user->id);
        //echo ($currentBalance);
        if (!empty($currentUserWalletInfo)){
            if (isset($currentUserWalletInfo->id) && $currentUserWalletInfo->id != '') {
                $userBalance += ($currentUserWalletInfo->balance ?? 0);
                //Wallet::update(['balance' => $userBalance]);
            }
        }
        
        //$currentBalance += $amountToAdd;
        Wallet::updateOrCreate(
            [
                'user_id'   => $user->id,
            ],
            [   'balance' => $userBalance
            ],
        );
        
        //
        echo "hii";
        print_r($order);
        exit;
        return redirect($order->short_url);
    }

    public function getUserBalance($userId)
    {
        if ((int)$userId > 0) {
            $wallet = Wallet::select('id', 'balance')->where('user_id', $userId)->first();
            if (!empty($wallet)){
                //$balance = $wallet->balance ?? 0;
                return $wallet;
            }
        }
        return null;
        
    }

}
