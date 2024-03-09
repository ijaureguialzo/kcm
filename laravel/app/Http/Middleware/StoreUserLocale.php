<?php

namespace App\Http\Middleware;

use App\Models\UserProfile;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\HttpFoundation\Response;

class StoreUserLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (Auth::check()) {
            $user = Auth::user();
            $locale = LaravelLocalization::getCurrentLocale();
            if (is_null($user->profile)) {
                UserProfile::updateOrCreate([
                    'locale' => $locale,
                    'user_id' => $user->id,
                ]);
            } else if ($user->profile->locale != $locale) {
                $user->profile->update(['locale' => $locale]);
            }
        }

        return $response;
    }
}
