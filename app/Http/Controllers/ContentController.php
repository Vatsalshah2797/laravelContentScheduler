<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Content;
use App\Models\User;
use App\Models\Customer;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Mail\ContentEmail;
use App\Http\Helpers\CommonTrait;
use App\Jobs\SendContentEmail;
use Illuminate\Support\Facades\Queue;


class ContentController extends Controller
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

        $walletBalance = 0;
        //$contents = Post::where('user_id', $user->id)->count();
        //$transactions = Post::where('user_id', $user->id)->count();
        //$content = Post::where('user_id', $user->id)->count();
        if (!empty($user) && isset($user->id)) {
            $walletBalance = $this->getUserWalletBalance($user->id);
            //$walletBalance = (int)$walletBalance;
        }

        $contents = Content::latest()->paginate(5);
        return view('contents.index', compact('contents', 'user', 'walletBalance'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('contents.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'title' => 'required',
            'message' => 'required'
        ]);
  
        $input = $request->all();
        //$input['user_id'] = $user->id;
        // if ($image = $request->file('image')) {
        //     $destinationPath = 'image/';
        //     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($destinationPath, $profileImage);
        //     $input['image'] = "$profileImage";
        // }
    
        Content::create($input);
     
        return redirect()->route('contents.index')
                ->with('success', 'Content created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        $customers = [];
        $user = Auth::user();

        $walletBalance = 0;
        if (!empty($user) && isset($user->id)) {
            $walletBalance = $this->getUserWalletBalance($user->id);
        }

        $customers = Customer::select('id','name')->where('user_id', $user->id)->latest()->get();
        if (!empty($customers)) {
            $customers = $customers->toArray();
            //s$customers = $customers[0] ?? [];
        }
        return view('contents.show', compact('content', 'user', 'customers', 'walletBalance'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        $user = Auth::user();
        return view('contents.edit', compact('content', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required'
        ]);
  
        $input = $request->all();
  
        // if ($image = $request->file('image')) {
        //     $destinationPath = 'image/';
        //     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        //     $image->move($destinationPath, $profileImage);
        //     $input['image'] = "$profileImage";
        // } else {
        //     unset($input['image']);
        // }
          
        $content->update($input);
    
        return redirect()->route('contents.index')
                ->with('success', 'content updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        $content->delete();
     
        return redirect()->route('contents.index')
                ->with('success', 'content deleted successfully.');
    }

    public function sendEmail(Request $request)
    {
        $user = Auth::user();
        //dd($request->all());
        //dd($id);
        //$content = Content::find($request->input('content_id'));
        $request->validate([
            'user_ids' => 'required|array|min:1',
            'title' => 'required',
            'message' => 'required'
        ]);
        $userIds = $request->input('user_ids');

        // Load users based on selected user IDs
        $customers = Customer::whereIn('id', $userIds)->get();
        $content = Content::find($request->input('content_id'));
        //print_r($content);

        $amountToDeduct = env('EMAIL_CHARGE', 7);
        $totalAmmountToBeDeduct = count($userIds) * $amountToDeduct;
        $currentUserWalletInfo = $this->getUserBalance($user->id);
        if (empty($currentUserWalletInfo)) {
            return redirect()->back()->with('error', 'Please add amount into your wallet for send email!');
        }
        //echo ($currentBalance);
        if (!empty($currentUserWalletInfo) && isset($currentUserWalletInfo->id) && $currentUserWalletInfo->id != ''
            ) {
                if (isset($currentUserWalletInfo->balance) && $currentUserWalletInfo->balance < $totalAmmountToBeDeduct) {
                    return redirect()->back()->with('error', 'Low Wallet Balance!');
                } else {
                    $userBalance = 0;
                    //$wallet = $this->getUserBalance($user->id);
                    foreach ($customers as $customer) {

                        //send mail through job
                        SendContentEmail::dispatch($user, $content, $amountToDeduct, $customer)
                        ->onQueue('emails');

                        // Send email to each user without job process
                        // $sendMail = Mail::to($customer->email)->send(new ContentEmail($content));
                        // if($sendMail) {
                        //     $currentUserWalletInfo = $this->getUserBalance($user->id);
                        //     //echo ($currentBalance);
                        //     if (!empty($currentUserWalletInfo)) {
                        //         if (isset($currentUserWalletInfo->id) && $currentUserWalletInfo->id != '') {
                        //             $userBalance = ($currentUserWalletInfo->balance ?? 0) - $amountToDeduct;
                        //         }
                        //     }
                        //     if ($userBalance > 0 && isset($user->id)) {
                        //         //$currentBalance += $amountToDeduct;
                        //         Wallet::updateOrCreate(
                        //             [
                        //                 'user_id'   => $user->id,
                        //             ],
                        //             [   'balance' => $userBalance
                        //             ],
                        //         );

                        //         //Save wallet transaction details
                        //         $wallet = WalletTransaction::create([
                        //             'wallet_id' => $currentUserWalletInfo->id,
                        //             'status' => 'Debited',
                        //             'payment_status' => 'Success',
                        //             'type' => 'Send Mail To Customer',
                        //             'customer_id' => $customer->id,
                        //             'amount' => $amountToDeduct,
                        //         ]);
                        //     } else {
                        //         return redirect()->back()->with('error', 'Something went wrong!');
                        //     }
                        // } else {
                        //     return redirect()->back()->with('error', 'Something went wrong!');
                        // }
                    }
                    // Redirect back with a success message
                    return redirect()->route('contents.index')->with('success', 'Content sent successfully to selected customers of user.');
                }
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }

        
    }

}
