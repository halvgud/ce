<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Factory as Auth;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;


class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    // protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    // public function __construct(Auth $auth)
    // {
    //     $this->auth = $auth;
    // }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   $signer = new Sha256();
        $data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)

        $stringtkn = $request->header('x-auth-token');
        if($stringtkn && $stringtkn !== ''){
            $key = env('token_key','someStupidThing');
            $token = (new Parser())->parse((string) $stringtkn);
            $expiration = $token->getClaim('exp');
            $uid = $token->getClaim('uid');
            $expoToken = md5($expiration);
            if($token->verify($signer, $key) && $token->validate($data)){
                $user = DB::table('users')->where([
                                ['id', '=', $uid],
                                ['user_token', '=', $expoToken],
                            ])->count();
                if($user>0){
                    return $next($request);
                }
            }
        }
        return response('Unauthorized.', 401);   
        // if ($this->auth->guard($guard)->guest()) {
        //     return response('Unauthorized.', 401);
        // }

    }
}
