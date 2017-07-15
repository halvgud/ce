<?php 

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Helpers\Response;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Parsing\Encoder;

class MenuItemsController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request; 
    }

    public function getitems()
    {
        $items = DB::table('menu')->get();
        if($items) {
            return Response::json($items);
        }

        return Response::internalError('Unable to create the user');
    }

    public function getDescriptions($type){
        $items = DB::table('descriptions')->select('description_id as id','description')
                    ->where([
                        ['type','=', $type],
                        ['state','=',1]
                            ])->get();
        if($items) {
            return Response::json($items);
        }

        return Response::internalError('Unable to create the user');   
    }
}