<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;


class UserController extends Controller
{
     public $successStatus = 200;

      /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
      // return response()->json(['Sucess'=>request('email').'=>'.request('password')], 200);     	 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
    	 //return response()->json(['sucess'=>$request], 401);  

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'user_id' => 'required',
            'user_name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);


        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);            
        }

 // return response()->json(['sucess'=>$input], 401);  exit;
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $success['user_id'] =  $user->user_id;


        return response()->json(['success'=>$success], $this->successStatus);
    }


    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }


}
