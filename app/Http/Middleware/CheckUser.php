<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\Token;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request_token = $reques->header('authorization');
        $token = new Token();
        $decoded_token = $token->decode($request_token);

        


        return $next($request);
    }
}
