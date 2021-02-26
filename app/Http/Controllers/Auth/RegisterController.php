<?php

namespace App\Http\Controllers\Auth;

use App\Model\API\CustomerMasterModel;
use App\Model\API\InvoiceMasters;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest', ['except' => ['edit', 'update']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //dd($data);
        return User::create([
            'name' => $data['name'],
            'mobile'=>$data['mobile'],
            'user_name'=>$data['email'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
        ]);
    }


    public function edit($id)
    {
        $user = User::where('id',$id)->first();
        $headData = $this->deshboard_count();
        return view('user.profile',compact('user','headData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OurServices  $ourServices
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    { 
        //  return Validator::make($data, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:3', 'confirmed'],
        // ]);

        //  $this->validate($user,[
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:3', 'confirmed'],
        // ]);


        $user->name = request('name');
        $user->email = request('email');     
        $user->address = request('address');     
        if(request('password'))$user->password = Hash::make(request('password'));
        $user->save();

        return back();
    }

     public   function deshboard_count()
    { 
        $paid=0;
        $unpaid=0;
        $totalamt=0;
        $recamt=0;
        $id = Auth::user()->user_name;         
        $cust_id=CustomerMasterModel::where('customer_code',$id)->first()->id;
        $Subscriptionquery = SaleSubscription::where('customer_code',$id)->count();
        $Invoicequery = InvoiceMasters::where('customer_id',$cust_id)->get();

        foreach ($Invoicequery as $row) {
          $totalamt = isset(InvoiceMasters::find($row->id)->ledgers()->first()->amount)?InvoiceMasters::find($row->id)->ledgers()->first()->amount:"0"; 
           $recamt =InvoiceMasters::find($row->id)->receipt()->sum('amount');
            if($totalamt==$recamt)
            {
             $paid++;
            }
            else{
             $unpaid ++;
            }
        }

        return array(
            'subscription' =>$Subscriptionquery,
            'invoice'=>$Invoicequery->count(),
            'paid'=>$paid,
            'unpaid'=>$unpaid
        );
    }
}
