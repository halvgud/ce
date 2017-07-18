<?php 

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Helpers\Response;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parsing\Encoder;

class LoginController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request; 
    }

    public function login()
    {
        if($this->request->has('username') && $this->request->has('password')){
            $username = $this->request->input('username');
            $pw = $this->request->input('password');
            // $password = password_hash($pw, PASSWORD_DEFAULT);
            $user = DB::table('users')->select('id','password')->where('username', $username)->first();
            if(password_verify($pw, $user->password)){
                $signer = new Sha256();
                $token = (new Builder())->setIssuer('clint_eastwood') // Configures the issuer (iss claim)
                                        ->setAudience('kwg') // Configures the audience (aud claim)
                                        ->setId($user->id, true) // Configures the id (jti claim), replicating as a header item
                                        ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
                                        ->setNotBefore(time()) // Configures the time that the token can be used (nbf claim)
                                        ->setExpiration(time() + 86400) // Configures the expiration time of the token (nbf claim)
                                        ->set('uid', $user->id) // Configures a new claim, called "uid"
                                        ->sign($signer, 'testing') // creates a signature using "testing" as key
                                        ->getToken(); // Retrieves the generated token
                $expiration = $token->getClaim('exp');
                $expoToken = md5($expiration);
                $affected = DB::table('users')
                    ->where('id', $user->id)
                    ->update(['user_token' => $expoToken]);
                if($affected > 0){
                    return Response::json((string)$token);
                }
            }
        }
        return response('Unauthorized.', 401);
    }
}