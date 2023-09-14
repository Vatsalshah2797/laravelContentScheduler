<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Helpers\CommonTrait;

class WalletTransactionController extends Controller
{
    use CommonTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $transactions = Wallet::select('user_id', 'id')->with(['walletTransaction' => function ($query) {
            $query->select('id', 'amount', 'status', 'payment_status', 'type', 'wallet_id');
        }])->where('user_id', $user->id)->latest()->first();

        $transactions = $transactions->walletTransaction ?? [];

        // if (!empty($transactions)){
        //     $transactions = $transactions->toArray();
        // }



        $walletBalance = 0;
        //$customers = Post::where('user_id', $user->id)->count();
        //$transactions = Post::where('user_id', $user->id)->count();
        //$content = Post::where('user_id', $user->id)->count();
        if (!empty($user) && isset($user->id)) {
            $walletBalance = $this->getUserWalletBalance($user->id);
            //$walletBalance = (int)$walletBalance;
        }
        return view('wallettransactions.index', compact('transactions', 'user', 'walletBalance'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WalletTransaction  $walletTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(WalletTransaction $walletTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WalletTransaction  $walletTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(WalletTransaction $walletTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WalletTransaction  $walletTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WalletTransaction $walletTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WalletTransaction  $walletTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(WalletTransaction $walletTransaction)
    {
        //
    }
}
