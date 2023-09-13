<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use this on top in the controller
use Razorpay\Api\Api;


class PaymentController extends Controller
{
    
    public function viewPayment(){
    
        return view('payment');
    
    }

    public function orderIdGenerate(Request $request){
    
        $api = new Api(config('app.razorpay_api_key'), config('app.seceret_key'));
        $order = $api->order->create(array('receipt' => 'order_rcptid_11', 'amount' => $request->input('amount') * 100, 'currency' => 'INR')); // Creates order
        return response()->json(['order_id' => $order['id']]);
    
    }

    public function storePayment(Request $request){
        //dd($request->all());
        $api = new Api(config('app.razorpay_api_key'), config('app.seceret_key'));
        //Fetch payment information by razorpay_payment_id
        $payment = $api->payment->fetch($request->input('razorpay_payment_id'));
        if (!empty($payment) && $payment['status'] == 'captured') {
            $paymentId = $payment['id'];
            $amount = $payment['amount'];
            $currency = $payment['currency'];
            $status = $payment['status'];
            $entity = $payment['entity'];
            $orderId = $payment['order_id'];
            $invoiceId = $payment['invoice_id'];
            $method = $payment['method'];
            $bank = $payment['bank'];
            $wallet = $payment['wallet'];
            $bankTranstionId = isset($payment['acquirer_data']['bank_transaction_id']) ? $payment['acquirer_data']['bank_transaction_id'] : '';
        } else {
            return redirect()->back()->with('error', 'Something went wrong, Please try again later!');
        }
        try {
            // Payment detail save in database
            $payment = new Payment;
            $payment->transaction_id = $paymentId;
            $payment->amount = $amount / 100;
            $payment->currency = $currency;
            $payment->entity = $entity;
            $payment->status = $status;
            $payment->order_id = $orderId;
            $payment->method = $method;
            $payment->bank = $bank;
            $payment->wallet = $wallet;
            $payment->bank_transaction_id = $bankTranstionId;
            $saved = $payment->save();
        } catch (Exception $e) {
            $saved = false;
        }
        if ($saved) {
            return redirect()->back()->with('success', __('Payment Detail store successfully!'));
        } else {
            return back()->withInput()->with('error', __('Something went wrong, Please try again later!'));
        }
    }
}
