<?php 

namespace App\Http\Controllers;

use App\Helpers\Response;
use App\Models\User;
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
        // $user = $this->request->input('store');
        // foreach ($user as $key => $value) {
            
        // }
        if($user) {
            $user->username = $this->request->input('username');
            $user->email = $this->request->input('email');
            $user->first_name = $this->request->input('first_name');
            $user->last_name = $this->request->input('last_name');
            $user->second_last_name = $this->request->input('second_last_name');
            $user->gender_id = $this->request->input('gender_id');
            $user->rol_id = $this->request->input('rol_id');
            $user->store_id = $this->request->input('store_id');
            $user->password = password_hash($this->request->input('password'), PASSWORD_DEFAULT);
            $user->status = 1;

            $user->save();
            return Response::created($user);
        }

        return Response::internalError('Unable to create the store');
    }

    public function getUsers(){
        $users = User::all();

        return Response::json($users);
    }

    public function getUser($search){
        // $items = DB::table('stores')->select('id','description','tag','address')
        //             ->where([
        //                 ['description','like', '%'.$search.'%'],
        //                 ['state','=',1]
        //                     ])->get();
        $users = User::where([
                        ['first_name','like', '%'.$search.'%'],
                        ['status','=',1]
                            ])->get();
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