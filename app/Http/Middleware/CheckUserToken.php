<?php
/**
 * Created by PhpStorm.
 * User: yevhen
 * Date: 20.06.18
 * Time: 11:09
 */

namespace App\Http\Middleware;

use App\UserAuthToken;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserToken extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next = null)
    {
        $user_auth_token = UserAuthToken::where('token', md5($request->headers->get('token')))->first();
        if ($user_auth_token){
            Auth::loginUsingId($user_auth_token->user_id);
            if($next){
                return $next($request);
            }
            return true;
        }
        return response('User not authorized',401);
    }
}