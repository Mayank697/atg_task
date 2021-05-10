<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiAuth
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
        $token = $request->header('API_KEY');

        if($token != "helloatg")
            return response()->json(["status" => 0, "message" => "Invalid API key"], 401);

        return $next($request);
    }
}
