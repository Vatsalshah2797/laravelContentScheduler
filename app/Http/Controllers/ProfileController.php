<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Helpers\CommonTrait;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use CommonTrait;

    public function show()
    {
        $walletBalance = 0;
        $user = Auth::user();
        if (!empty($user) && isset($user->id)) {
            $walletBalance = $this->getUserWalletBalance($user->id);
        }
        return view('auth.profile', compact('user', 'walletBalance'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        if ($request->password) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
        }

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Profile updated.');
    }
}
