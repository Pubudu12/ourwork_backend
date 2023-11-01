<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class AuthController extends Controller
{
    
    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------*/
   
    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails()){
            $message = 'Please Enter All Details!';
        }

        // $token_valkidity = 24 * 60;
        $redirect  = '';
        $value = 0;
        $message = '';

        if (User::where('name','=',$request['username'])->count() > 0) {
            if (Auth::attempt(['name' => $request['username'], 'password' => $request['password'] ])) {

                $details = DB::table('users')->where('name', $request['username'])->select('id','name')->first();
                $request->session()->put('user_id', $details->id);
                $request->session()->put('user_name', $details->name);

                $redirect  = '/dashboard';
                $value = 1;
                $message = 'Login successful!';
            }else {
                $message = "password does not match";
            }
        }else{
                $message = "Username does not exist";
            }

        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));
    }//login()


    /*
    |--------------------------------------------------------------------------
    | Register
    |--------------------------------------------------------------------------*/
    
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        if($validator->fails()){
            $message = 'Please Enter All Details!';
        }

        $user = new User();
        $enc_pwd = Hash::make ($request['password']);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=$enc_pwd;
        $user->level=1;
        $user->status=1;

        $res = $user->save();

        if($res){
            $message = 'User Registered Successfully';
            $value = 1;
            $redirect = '/users';
        }else{
            $message = 'User is not Registered';
        }

        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));

    }//register()



    public function CurrentUser(){
        $user_id = Session::get('user_id');
        $username = Session::get('user_name');
        // return view('theme/partials/home',['username'=>$username]);
        return view('theme/partials/sidebar',['username'=>$username]);
    }



    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------*/

    public function logoutAdmin(Request $request){
        Auth::logout();
        Session::forget('user_id');
        Session::forget('user_name');
        return Redirect::to('/login');
    }//logoutAdmin()
    


    /*
    |--------------------------------------------------------------------------
    | Show Users
    |--------------------------------------------------------------------------*/

    function showUsers(){
        $user_data = User::all();
        return view('admin/users',['user_data'=>$user_data]);
    }//showUsers()


    /*
    |--------------------------------------------------------------------------
    | Update Password
    |--------------------------------------------------------------------------*/

    function showData($id){
        $data = User::find($id);
        return view('admin/updatePassword',['data'=>$data]);
        // return $data;
    }

    function updatePassword(Request $req){
        $message = '';
        $value = 0;
        $redirect = '';
        $data = User::find($req->id);

        $validation = Validator::make($req->all(), [
            'password' => 'required|min:6',
            'c_password' => 'required|min:6'
        ]);
        
        if ($validation->fails()) {
            $message = 'Please fill all fields!';
        }else{

            $pw = $req->password;
            $c_pw=$req->c_password;

            if($pw == $c_pw){
                $enc_pwd = Hash::make ($req['password']);          
                $data->password=$enc_pwd;

                $res = $data->save();

                if ($res) {
                    $message = 'Password Updated Successfully';
                    $value = 1;
                    $redirect = '/users';
                } else {
                    $message = 'Password is not updated';
                }
            }else{
                $message = 'Passwords does not match!';
            }

            
        }
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));   
    }//updatePassword()


    /*
    |--------------------------------------------------------------------------
    | Delete Users
    |--------------------------------------------------------------------------*/

    function deleteUsers($id){
        $message = '';
        $value = 0;
        $redirect = '';
        $data = User::find($id);
        
        $res =  $data->delete();

        if($res){
            $message = 'User deleted Successfully';
            $value = 1;
            $redirect = '/users';
        }else {
            $message = 'User is not deleted';
        }
    
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));
    }//deleteUsers()

}
