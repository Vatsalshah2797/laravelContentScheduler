<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContentEmail;
//use App\User;
//use App\Content;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Http\Helpers\CommonTrait;

class SendContentEmail {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, CommonTrait;

    protected $user;
    protected $content;
    protected $amountToDeduct;
    protected $customer;

    /**
     * Create a new job instance.
     *
     * @param  \App\User  $user
     * @param  \App\Content  $content
     * @return void
     */
    public function __construct($user, $content, $amountToDeduct, $customer)
    {
        $this->user = $user;
        $this->content = $content;
        $this->amountToDeduct = $amountToDeduct;
        $this->customer = $customer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //echo "innnn";exit;
        //echo $this->customer->email;
        // Send the email using the ContentEmail Mailable
        $sendMail = Mail::to($this->customer->email)
            ->send(new ContentEmail($this->content));
        
        \Log::info(['start']);
        if ($sendMail) {
            $currentUserWalletInfo = $this->getUserBalance($this->user->id);
            //echo ($currentBalance);
            if (!empty($currentUserWalletInfo)) {
                if (isset($currentUserWalletInfo->id) && $currentUserWalletInfo->id != '') {
                    $userBalance = ($currentUserWalletInfo->balance ?? 0) - $this->amountToDeduct;
                }
            }
            if ($userBalance > 0 && isset($this->user->id)) {
                //$currentBalance += $amountToDeduct;
                Wallet::updateOrCreate(
                    [
                        'user_id'   => $this->user->id,
                    ],
                    [   'balance' => $userBalance
                    ],
                );

                //Save wallet transaction details
                $wallet = WalletTransaction::create([
                    'wallet_id' => $currentUserWalletInfo->id,
                    'status' => 'Debited',
                    'payment_status' => 'Success',
                    'type' => 'Send Mail To Customer',
                    'customer_id' => $this->customer->id,
                    'amount' => $this->amountToDeduct,
                ]);
                \Log::info(['donee']);
                // Redirect back with a success message
                //return redirect()->route('contents.index')->with('success', 'Content sent successfully to selected customers of user.');
            } 
            //else {
                //return redirect()->back()->with('error', 'Something went wrong!');
            //}
        } 
        // else {
        //     return redirect()->back()->with('error', 'Something went wrong!');
        // }
        
    }
}
