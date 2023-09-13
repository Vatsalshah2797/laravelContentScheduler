<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Helpers\CommonTrait;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //public $user = null;
    use CommonTrait;
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->user = Auth::user();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        //$customers = $transactions =  0;
        $walletBalance = 0;
        $user  = Auth::user();
        //$customers = Post::where('user_id', $user->id)->count();
        //$transactions = Post::where('user_id', $user->id)->count();
        //$content = Post::where('user_id', $user->id)->count();
        if (!empty($user) && isset($user->id)) {
            $walletBalance = $this->getUserWalletBalance($user->id);
            //$walletBalance = (int)$walletBalance;
        }
        //echo $walletBalance;exit;
        return view('dashboard', compact('walletBalance', 'user'));
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function myProfile()
    {
        $walletBalance = 0;
        $user = Auth::user();
        if (!empty($user) && isset($user->id)) {
            $walletBalance = $this->getUserWalletBalance($user->id);
        }
        return view('profile', compact('user', 'walletBalance'));
    }
}
