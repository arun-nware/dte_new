<?php

namespace App\Http\Controllers\Auth;

use App\Events\SendOtpOnLoginEvent;
use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmableLoginOtpController extends Controller
{
    /**
     * Show the confirm password view.
     */
    public function show(): View
    {
        return view('auth.confirm-otp');
    }

    /**
     * Confirm the user's password.
     */
    public function store(Request $request): RedirectResponse
    {

        if (! Otp::where('otp', $request->otp)->where('created_at', '<', Carbon::now()->subMinute(5))->latest()) {
            throw ValidationException::withMessages([
                'otp' => __('Your OTP is expired. Please try again'),
            ]);
        }

        $request->session()->put('auth.otp_verified_at', time());
        //update otp_verified_at column
        User::updateOptVerifiedAt();
        User::updateLastLogindAt();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function resend()
    {
        $user = Auth::user();

        $count = Otp::where(DB::raw('date(created_at)'), Carbon::now()->format('Y-m-d'))->get()->count();

        if ($count > 3) {
            return redirect('/')->with('status', 'You have exceeded the maximum number of otp attempts. Please after 24Hrs.');
        }
        event(new SendOtpOnLoginEvent($user));

        return back()->with('status', 'OTP resent successfully');
    }
}
