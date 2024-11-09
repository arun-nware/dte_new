<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

//    protected function unauthenticated($request, array $guards)
//    {
//        if (isset($guards[0]) && $guards[0] == 'api') {
//            abort(response()->json(
//                [
//                    "reqDate" => $request["reqDate"],
//                    "reqTime" => $request["reqTime"],
//                    "response" => "FAILED",
//                    "respCode" => "401",
//                    "resDate" => date('Ymd'),
//                    "resTime" => date('His'),
//                    'message' => 'UnAuthenticated',
//                ], 401));
//        } else {
//            Auth::guard('web')->logout();
//
//            $request->session()->invalidate();
//
//            $request->session()->regenerateToken();
//            return redirect('/');
//            dd(123);
//
//        }
//    }
}
