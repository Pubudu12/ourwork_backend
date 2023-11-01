<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;

// use App\Models\User;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $user = Auth::user();
        Auth::check();

        if (!Auth::check()) {
            $unauthorized_response = array(
                'user_type' => 'Sorry',
                'error' => 'Not authorized',
            );

            return response()->json($unauthorized_response, 403);
        }

        return $next($request);


    }
}
