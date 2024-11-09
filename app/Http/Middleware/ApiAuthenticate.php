<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class ApiAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    protected function unauthenticated($request, array $guards)
    {
        abort(response()->json(
            [
                "reqDate" => $request["reqDate"],
                "reqTime" => $request["reqTime"],
                "response" => "FAILED",
                "respCode" => "401",
                "resDate" => date('Ymd'),
                "resTime" => date('His'),
                'message' => 'UnAuthenticated',
            ], 401));
    }
}
