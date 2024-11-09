<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckPasswordExpiry
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $passwordRecord = DB::table('manage_passwords')->where('user_id', $user->id)->first();

            $lastUpdated = $passwordRecord ? $passwordRecord->updated_at : $user->created_at;

            session(['password_expired' => false]);

            if (now()->diffInDays($lastUpdated) >= 30) {
                session(['password_expired' => true]);
            }
        }
        return $next($request);
    }
}

