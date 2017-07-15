<?php 

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Helpers\Response;

class StoresController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request; 
    }

    public function postStores()
    {   
        $store = $this->request->input('store');
        // foreach ($store as $key => $value) {
            
        // }
        if($store) {
            $store['state'] = 1;
            $id = DB::table('stores')->insertGetId(
               $store
            );
            return Response::json($id);
        }

        return Response::internalError('Unable to create the store');
    }

    public function getStores($search){
        $items = DB::table('stores')->select('store_id as id','description','tag','address')
                    ->where([
                        ['description','like', '%'.$search.'%'],
                        ['state','=',1]
                            ])->get();
        if($items) {
            return Response::json($items);
        }

        return Response::internalError('Unable to create the store');   
    }
}