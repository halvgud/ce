<?php 

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Models\User;
use App\Models\Description;
use App\Models\Store;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class UserController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request; 
    }

    public function postUser(Request $request)
    {   
        $user = new User;
        $data = $request->all();
        if($user) {
            $user->fill($data);
            $user->password = password_hash($this->request->input('password'), PASSWORD_DEFAULT);

            $user->save();
            return Response::created($user);
        }

        return Response::internalError('Unable to create the store');
    }
    public function editUser(Request $request){
        $data = $request->all();
        $user = User::with(['gender','store'])->find($data['id']);
        $gender =(isset($data['gender']) && isset($data['gender']['id']))?Description::find($data['gender']['id']):'';
        $store =(isset($data['store']) && isset($data['store']['id']))?Store::find($data['store']['id']):'';
        if($user) {
            $user->fill($data);
            if($gender)
                $user->gender()->associate($gender);
            if($store)
                $user->store()->associate($store);
            $user->save();
            return Response::created($user);
        }
        return Response::internalError('Unable save user data');
    }

    public function getUsers(){
        $users = User::all();

        return Response::json($users);
    }

    public function getUserByName($search){
        $users = User::where([
                        ['first_name','like', '%'.$search.'%'],
                        ['status','=',1]
                            ])->get();
        if($users) {
            return Response::json($users);
        }

        return Response::internalError('Unable to create the store');   
    }
    public function getUserById($search){
        $users = User::with(['gender','store'])->find($search);
        if($users) {
            return Response::json($users);
        }

        return Response::internalError('Unable to create the store');   
    }
    public function delete($id){
        $user = User::find($id);
        return Response::json($user->delete());
    }
}