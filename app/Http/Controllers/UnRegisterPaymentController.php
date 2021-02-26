<?php

namespace App\Http\Controllers;

use App\Model\UnRegisterPayment;
use Illuminate\Http\Request;
use Softon\Indipay\Facades\Indipay;  
 


class UnRegisterPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('unreg_payment');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $this->validate($request,[
        'name'=>'required',
        'mobile'=>'required',
        'email'=>'required',
        'amount'=>'required|numeric',
        'address'=>'required|min:5',
       ]); 

        $tid=time();
        // echo "<pre>";
        //     print_r($customer_mst);
        // exit;
        $gateway= new UnRegisterPayment();
        $gateway->asset_id=1;
        $gateway->ledger_name=$request->name;
        $gateway->account_name=$request->name;
        $gateway->email=$request->email;
        $gateway->address=$request->address;
        $gateway->amount=$request->amount;
        $gateway->date=now();
        $gateway->tran_type ='Electronic';
        $gateway->save();
        $identity =$gateway->id;
 $parameters = [
        'order_id' => $identity,
        'tid' => $tid,
        'amount' => $request->amount,
        'allow_repeated_payments' => 'true',
        'delivery_name' => $request->name,
        'billing_email' => $request->email,
        'delivery_address' => $request->address,
        // 'billing_zip' => $inputs['pincode'],
        // 'billing_city' => $inputs['city'],
        // 'billing_state' => $inputs['state'],
        'delivery_tel' => $request->mobile,
        'delivery_country' => 'India',
        'redirectUrl' => 'paymentget/unregisterpayment-status',
        'cancelUrl' => 'paymentget/unregisterpayment-cancel'        
    ];
      //print_r($parameters);exit;
      // gateway = CCAvenue / PayUMoney / EBS / Citrus / InstaMojo / ZapakPay / Mocker
      
      // $order = Indipay::gateway('CCAvenue')->prepare($parameters);
      // return Indipay::process($order);
   

    $order = Indipay::prepare($parameters);
    return Indipay::process($order);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       print_r($request);exit;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UnRegisterPayment  $unRegisterPayment
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UnRegisterPayment  $unRegisterPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(UnRegisterPayment $unRegisterPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UnRegisterPayment  $unRegisterPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnRegisterPayment $unRegisterPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UnRegisterPayment  $unRegisterPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnRegisterPayment $unRegisterPayment)
    {
        //
    }


   public function paymentStatus()
  { 
    $response = Indipay::response(request());
    $gateway = UnRegisterPayment::find($response['order_id']);
    $gateway->tran_type = $response['payment_mode'];
    $gateway->bank_name = $response['card_name'];
    $gateway->tran_number = $response['tracking_id'];
    $gateway->trans_remarks = $response['status_message'];
    $gateway->bank_ref_no = $response['bank_ref_no'];
    $gateway->trans_date =$response['trans_date']; 

    if($response['order_status'] = 'Success')
    { 
      $gateway->payment_status = 1;

      $gateway->save();
    }
    else
    { 
      $transaction->payment_status = 2;

      $transaction->save();

      // return view('welcome', compact('transaction'));
    }
    return redirect(route('home'));
  } 
     
public function paymentCancel()
  {
   
            $response = Indipay::response(request());
            $gateway = UnRegisterPayment::find($response['order_id']);
            $gateway->payment_mode = $response['payment_mode'];
            $gateway->bank_name = $response['card_name'];
            $gateway->tran_number = $response['tracking_id'];
            $gateway->trans_remarks = $response['status_message'];
            $gateway->bank_ref_no = $response['bank_ref_no'];
            $gateway->trans_date =$response['trans_date'];
            $gateway->payment_status = '3';
           
            $gateway->save();
      return redirect(route('/'));
  }
   
}
