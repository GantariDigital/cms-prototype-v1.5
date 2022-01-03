<?php

namespace App\Http\Controllers\Auth\OtpUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Guards\OtpUser,
};
use Auth;

class LoginController extends Controller
{
    public function loginForm(Request $request)
    {
        $token = $request->query('token');
        $otp_user = OtpUser::where('token', $token)->firstOrFail();
        return view('auth.otp_user.login')->with(['token_user' => $token]);
    }

    public function login(Request $request)
    {
        $token = $request->query('token');
        $otp_user = OtpUser::where('token', $token)->firstOrFail();
        if(strcmp($otp_user->access_code, $request->input('otp')) == 0) {
            Auth::guard('otp_user')->login($otp_user);
            //Authentication passed...
            return redirect()->route('dashboard');
        }
        return redirect()->back()->withErrors(['otp_code' => 'OTP not valid!']);
    }

    public function logout(Request $request)
    {
        Auth::guard('otp_user')->logout();
        return redirect()->route('login');
    }
}
