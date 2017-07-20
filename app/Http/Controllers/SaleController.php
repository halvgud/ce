<?php 

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Models\Sale;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class SaleController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request; 
    }

    public function postSale()
    {   
        $store = new Sale();
        // $store = $this->request->input('store');
        // foreach ($store as $key => $value) {
            
        // }
        if($store) {
            //  $store->name = $this->request->name;
            // $store->address = $this->request->address;
            // $store->phone = $this->request->phone;
            // $store->email = $this->request->email;

            $store->name = $this->request->input('name');
            $store->address = $this->request->input('address');
            $store->phone = $this->request->input('phone');
            $store->email = $this->request->input('email');

            $store->status = 1;
            $store->save();
            return Response::created($store);
        }

        return Response::internalError('Unable to create the store');
    }

    public function getSales(){
        $sales = Sale::all();

        return Response::json($sales);
    }

    public function getStore($search){
        // $items = DB::table('stores')->select('id','description','tag','address')
        //             ->where([
        //                 ['description','like', '%'.$search.'%'],
        //                 ['state','=',1]
        //                     ])->get();
        $sales = Sale::where([
                        ['name','like', '%'.$search.'%'],
                        ['status','=',1]
                            ])->get();
        if($sales) {
            return Response::json($sales);
        }

        return Response::internalError('Unable to create the store');   
    }
    public function delete($id){
        $store = Sale::find($id);
        return Response::json($store->delete());
    }
}