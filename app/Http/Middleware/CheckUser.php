<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
class CheckUser
{
    public function handle(Request $request, Closure $next,...$roles)
    {
        try {
            $token = $request->header('Authorization');
            $request->headers->set('auth-token', (string) $token, true);
            $request->headers->set('Authorization', 'Bearer '.$token, true);
            $user = JWTAuth::parseToken()->authenticate();
            $auth=false;
            foreach ($roles as $role) {
                if (Auth::check() && $user->type == $role) {
                    $auth = true;
                }
            }
            if($auth==false){
                return response()->json(['Auth' => 'you are not auth']);
            }

        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['status' => 'Token is Invalid'])->setStatusCode(401) ;
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['status' => 'Token is Expired'])->setStatusCode(401) ;
            } else {
                return response()->json(['status' => 'Authorization Token not found']);
            }
        }
        return $next($request);
    }

}
