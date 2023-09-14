<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Redirect;
use App\Models\Payment;
use App\Models\Wallet;
use App\Http\Helpers\CommonTrait;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Auth;

class RazorpayController extends Controller
{
    use CommonTrait;
    
    public function razorpay()
    {
        return view('razorpay.index');
    }

    public function payment(Request $request)
    {
        $input = $request->all();
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id']))
        {
            try
            {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 

            } 
            catch (\Exception $e)
            {
                return  $e->getMessage();
                \Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
        
        \Session::put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
        return redirect()->back();
    }

    public function store(Request $request) {
        $input = $request->all();
        $user = Auth::user();
        print_r($input);
        $api = new Api (env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if(count($input) && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
                
                $wallet = $this->getUserBalance($user->id);
                if (!empty($response) && $response['status'] == 'captured') {//Success
                    $bankTranstionId = isset($payment['acquirer_data']['bank_transaction_id']) ? $payment['acquirer_data']['bank_transaction_id'] : '';
                    //Save payment transaction details
                    $payment = Payment::create([
                        'transaction_id' => $response['id'],
                        'method' => $response['method'],
                        'currency' => $response['currency'],
                        'status' => $response['status'],
                        'entity' => $response['entity'],
                        'order_id' => $response['order_id'],
                        'invoice_id' => $response['invoice_id'],
                        'bank' => $response['bank'],
                        'wallet' => $response['wallet'],
                        'bank_transaction_id' => $bankTranstionId,
                        //'user_email' => $response['email'],
                        'amount' => $response['amount']/100,
                        //'json_response' => json_encode((array)$response)
                    ]);

                    //Add wallet balance
                    $amountToAdd = $response['amount']/100;
                    $userBalance = $amountToAdd;
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

                    //Save wallet transaction details
                    $wallet = WalletTransaction::create([
                        'wallet_id' => $wallet->id,
                        'status' => 'Credited',
                        'payment_status' => 'Success',
                        'type' => 'Add To Wallet',
                        'customer_id' => null,
                        'amount' => $response['amount']/100,
                    ]);

                    return redirect()->back()->with('success', 'Payment Succefully Done!');
                } else {//Failed Transaction
                    $bankTranstionId = isset($payment['acquirer_data']['bank_transaction_id']) ? $payment['acquirer_data']['bank_transaction_id'] : '';
                    //Save payment transaction details
                    $payment = Payment::create([
                        'transaction_id' => $response['id'],
                        'method' => $response['method'],
                        'currency' => $response['currency'],
                        'status' => $response['status'],
                        'entity' => $response['entity'],
                        'order_id' => $response['order_id'],
                        'invoice_id' => $response['invoice_id'],
                        'bank' => $response['bank'],
                        'wallet' => $response['wallet'],
                        'bank_transaction_id' => $bankTranstionId,
                        //'user_email' => $response['email'],
                        'amount' => $response['amount']/100,
                        //'json_response' => json_encode((array)$response)
                    ]);

                    //Save wallet transaction details
                    $wallet = WalletTransaction::create([
                        'wallet_id' => $wallet->id,
                        'status' => 'Credited',
                        'payment_status' => 'Fail',
                        'type' => 'Add To Wallet',
                        'customer_id' => null,
                        'amount' => $response['amount']/100,
                    ]);
                    
                    return redirect()->back()->with('error', 'Something went wrong, Please try again later!');
                }
            } catch(\Exception $e) {
                
                //return $e->getMessage();
                \Session::put('error',$e->getMessage());
                //return redirect()->back();
                return back()->withInput()->with('error', __('Something went wrong, Please try again later!'));
            }

        }
        \Session::put('success','Payment Successful');
        return redirect()->back();
    }
}
