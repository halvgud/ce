<?php 

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Models\Description;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class DescriptionController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request; 
    }

    public function postStore()
    {   
        $store = new Description;
        // $store = $this->request->input('store');
        // foreach ($store as $key => $value) {
            
        // }
        if($store) {
            //  $store->name = $this->request->name;
            // $store->address = $this->request->address;
            // $store->phone = $this->request->phone;
            // $store->email = $this->request->email;

         /*   $store->name = $this->request->input('name');
            $store->address = $this->request->input('address');
            $store->phone = $this->request->input('phone');
            $store->email = $this->request->input('email');

            $s*tore->status = 1;
            $store->save();
            return Response::created($store);*/
        }

        return Response::internalError('Unable to create the store');
    }

    public function getAll(){
        $stores = Description::all();

        return Response::json($stores);
    }

    public function get($search){
        // $items = DB::table('stores')->select('id','description','tag','address')
        //             ->where([
        //                 ['description','like', '%'.$search.'%'],
        //                 ['state','=',1]
        //                     ])->get();
        $stores = Description::where([
                        ['type','=',$search]
                            ])->get();
        if($stores) {
            return Response::json($stores);
        }

        return Response::internalError('Unable to create the store');   
    }
    public function delete($id){
        $store = Description::find($id);
        return Response::json($store->Description());
    }
}