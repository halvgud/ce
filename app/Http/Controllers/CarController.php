<?php 

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class CarController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request; 
    }

    public function postCar(Request $request)
    {   
        $store = new Car;
        // $store = $this->request->input('store');
        // foreach ($store as $key => $value) {
            
        // }
        if($store) {
            $store->customer_id=$this->request->input('customer_id');
            $store->license_plate=$this->request->input('license_plate');
            $store->brand=$this->request->input('brand');
            $store->line=$this->request->input('line');
            $store->color=$this->request->input('color');
            $store->cylinders=$this->request->input('cylinders');
            $store->starting_mileage=$this->request->input('starting_mileage');
            $store->current_mileage=$this->request->input('current_mileage');
            $store->protective=$this->request->input('protective');
            $store->starting_odometer=$this->request->input('starting_odometer');
            $store->current_odometer=$this->request->input('current_odometer');
            $store->driver=$this->request->input('driver');
            $store->liter=$this->request->input('liter');
            $store->endowment_type=$this->request->input('endowment_type');
            $store->fuel_type=$this->request->input('fuel_type');
            //var_dump($store);

            $store->save();
            return Response::created($store);
        }

        return Response::internalError('Error al guardar el vehiculo');
    }

    public function getCars(){
        $sales = Car::all();

        return Response::json($sales);
    }
    public function getCarBrands(){
        $brand = CarBrand::all();
        return Response::json($brand);
    }
    public function getCarModels($search){
        $model = CarModel::where([
                        ['car_brand_id','=',$search]])->get();
        if($model){
            return Response::json($model);
        }
        return Response::internalError('Error al guardar el vehiculo');
    }

    public function getCar($search){
        // $items = DB::table('stores')->select('id','description','tag','address')
        //             ->where([
        //                 ['description','like', '%'.$search.'%'],
        //                 ['state','=',1]
        //                     ])->get();
        $sales = Car::where([
                        ['license_plate','like', '%'.$search.'%']
                            ])->get();
        if($sales) {
            return Response::json($sales);
        }

        return Response::internalError('Error al guardar el vehiculo');
    }


    public function delete($id){
        $store = Car::find($id);
        return Response::json($store->delete());
    }
}