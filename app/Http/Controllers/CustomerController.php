<?php 

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class CustomerController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request; 
    }

    public function postCustomer(Request $request)
    {   
        $customer = new Customer;
        if($customer) {
            $customer->name = $this->request->input('name');
            $customer->representative = $this->request->input('representative');
            $customer->credit_days = $this->request->input('credit_days');
            $customer->credit_limit = $this->request->input('credit_limit');
            $customer->fiscal_id = $this->request->input('fiscal_id');
            $customer->city = $this->request->input('city');
            $customer->state = $this->request->input('state');
            $customer->country = $this->request->input('country');
            $customer->postal_code = $this->request->input('postal_code');
            $customer->save();
            return Response::created($customer);
        }

        return Response::internalError('Unable to create the customer');
    }

    public function getCustomers(){
        $customers = Customer::all();

        return Response::json($customers);
    }
    public function getCustomerById($id){
        //$users = Customer::with(['gender','store'])->find($search);
        $customer = Customer::find($id);
        if($customer) {
            return Response::json($customer);
        }

        return Response::internalError('Unable to create the store');   
    }

    public function getCustomer($search){
        // $items = DB::table('stores')->select('id','description','tag','address')
        //             ->where([
        //                 ['description','like', '%'.$search.'%'],
        //                 ['state','=',1]
        //                     ])->get();
        $customers = Customer::where([
                        ['name','like', '%'.$search.'%']
                            ])->get();
        if($customers) {
            return Response::json($customers);
        }

        return Response::internalError('Unable to create the store');   
    }
    public function delete($id){
        $customer = Customer::find($id);
        return Response::json($customer->delete());
    }
}