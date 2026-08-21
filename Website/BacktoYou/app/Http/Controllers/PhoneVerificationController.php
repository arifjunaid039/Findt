<?php

namespace App\Http\Controllers;

use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PhoneVerificationController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function show()
    {
        $user = Auth::user();

        if ($user->phone_verified_at) {
            return redirect()->route('dashboard');
        }

        return view('auth.verify-phone', ['phone' => $user->phone]);
    }

    public function send(Request $request)
    {
        $user = Auth::user();

        if (!$user->phone) {
            return back()->with('error', 'No phone number found on your account.');
        }

        $otp = $this->otpService->generateAndSend($user->id, $user->phone);

        // Dev mode: show OTP directly on screen for local testing/demo
        if (app()->environment('local')) {
            return back()->with('success', 'OTP sent to your phone.')->with('dev_otp', $otp);
        }

        return back()->with('success', 'OTP sent to your phone.');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $user = Auth::user();
        $verified = $this->otpService->verify($user->id, $request->otp);

        if (!$verified) {
            return back()->with('error', 'Invalid or expired OTP. Please try again.');
        }

        return redirect()->route('register.success')->with('success', 'Phone verified successfully!');
    }

    public function resend(Request $request)
    {
        return $this->send($request);
    }
}