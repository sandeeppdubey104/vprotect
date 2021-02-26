<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HomeController;
use App\Model\API\CustomerMasterModel;
use App\Model\API\InvoiceMasters;
use App\Model\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Softon\Indipay\Facades\Indipay;
 

class PaymentGatewayController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return   response()->json(PaymentGateway::with('asset_dt')->where('is_synced',0)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id,$amount)
    {
        $inv_mst=InvoiceMasters::find($id);
        $customer_mst=CustomerMasterModel::find($inv_mst->customer_id);
        $tid=time();
    $batch_id=(PaymentGateway::max('batch_id')!==null?PaymentGateway::max('batch_id'):"0")+1;
        // echo "<pre>";
        //     print_r($batch_id);
        // exit;
        $gateway= new PaymentGateway();        
        $gateway->cust_id=$customer_mst->id;
        $gateway->asset_id=1;
        $gateway->batch_id=$batch_id;
        $gateway->customer_code=$customer_mst->customer_code;
        $gateway->inv_id=$inv_mst->id;
        $gateway->tally_inv_no=$inv_mst->invoice_number;
        $gateway->ledger_name=$customer_mst->fname;
        $gateway->account_name=$customer_mst->fname;
        $gateway->amount=$amount;
        $gateway->date=now();
        $gateway->tran_type ='Electronic';
        $gateway->pay_type ='inv';
        $gateway->save();
        $identity =$gateway->id;
 $parameters = [
        'order_id' => $batch_id,
        'tid' => $tid,
        'amount' => $amount,
        'allow_repeated_payments' => 'true',
        'delivery_name' => $customer_mst->fname,
        'billing_email' => $customer_mst->email,
        'delivery_address' => $customer_mst->address,
        // 'billing_zip' => $inputs['pincode'],
        // 'billing_city' => $inputs['city'],
        // 'billing_state' => $inputs['state'],
        'delivery_tel' => $customer_mst->phone,
        'delivery_country' => 'India',
        'redirectUrl' => 'paymentget/payment-status',
        'cancelUrl' => 'paymentget/payment-cancel'        
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
      
   
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentGateway  $PaymentGateway
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentGateway $PaymentGateway)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentGateway  $PaymentGateway
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentGateway $PaymentGateway)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentGateway  $PaymentGateway
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
         
        $resid = json_decode(file_get_contents("php://input"));
        // echo "<pre>";
        // print_r($resid);
        // exit; 
        // $gateway = PaymentGateway::whereIn('id',$resid);
        // $gateway->is_synced = 1;
        // $gateway->synced_date = now();
        // $gateway->save();
        $itemTypes = [1, 2, 3, 4, 5];

PaymentGateway::whereIn('id', $resid)
    ->update([
        'is_synced' => '1',
        'synced_date' =>  now()
    ]);


        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentGateway  $PaymentGateway
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentGateway $PaymentGateway)
    {
        //
    }

public function paymentStatus()
  {
    $response = Indipay::response(request());
    $gateways = PaymentGateway::where('batch_id',$response['order_id'])->get();
    foreach($gateways as $gateway){
    //$gateway->tran_type = $response['payment_mode'];
    $gateway->bank_name ="HDFC BANK"; //$response['card_name'];
    $gateway->tran_number = $response['tracking_id'];
    $gateway->trans_remarks = $response['status_message'];
    $gateway->bank_ref_no = $response['bank_ref_no'];
    $gateway->trans_date =$response['trans_date']; 


    if($response['order_status'] = 'Success')
    { 
      $gateway->payment_status = 1;
      $gateway->save();
      //$this->receipt($transaction->transaction_id);
      //event(new OrderWasCreated($transaction));
    // echo "<pre>";
    // print_r($response);
    // exit;
    //   return view('welcome', compact('transaction', 'email'));
      //return redirect(routes('home'));
    }
    else
    { 
      $transaction->payment_status = 2;

      $transaction->save();
      // return view('welcome', compact('transaction'));
    }
  }
    return redirect(route('home'));
  } 
     
public function paymentCancel()
  {
   
            $response = Indipay::response(request());
            $gateway = PaymentGateway::find($response['order_id']);
            $gateway->payment_mode = $response['payment_mode'];
            $gateway->bank_name ="HDFC BANK"; //$response['card_name'];
            $gateway->tran_number = $response['tracking_id'];
            $gateway->trans_remarks = $response['status_message'];
            $gateway->bank_ref_no = $response['bank_ref_no'];
            $gateway->trans_date =$response['trans_date'];
            $gateway->payment_status = '3';
           
            $gateway->save();
      return redirect(route('home'));
  }

      public function adv_pay()
      { 
         $deshboard_count = new HomeController();

         $headData = $deshboard_count->deshboard_count();
         return view('user.adv_payment',compact('headData'));
      }
    public function advpay_create()
    { 
        $data=request()->all();
        $customer_mst=CustomerMasterModel::find(Auth::user()->id);
        $tid=time();
        $amount=$data['txtamount'];
    $batch_id=(PaymentGateway::max('batch_id')!==null?PaymentGateway::max('batch_id'):"0")+1;

        $gateway= new PaymentGateway();
        $gateway->cust_id=$customer_mst->id;
        $gateway->asset_id=1;
        $gateway->batch_id=$batch_id;
        $gateway->customer_code=$customer_mst->customer_code;
        $gateway->inv_id='';
        $gateway->tally_inv_no='';
        $gateway->ledger_name=$customer_mst->fname;
        $gateway->account_name=$customer_mst->fname;
        $gateway->amount=$amount;
        $gateway->date=now();
        $gateway->tran_type ='Electronic';
        $gateway->pay_type ='adv';
        $gateway->save();
        $identity =$gateway->id;
 $parameters = [
        'order_id' => $batch_id,
        'tid' => $tid,
        'amount' => $amount,
        'allow_repeated_payments' => 'true',
        'delivery_name' => $customer_mst->fname,
        'billing_email' => $customer_mst->email,
        'delivery_address' => $customer_mst->address,
        // 'billing_zip' => $inputs['pincode'],
        // 'billing_city' => $inputs['city'],
        // 'billing_state' => $inputs['state'],
        'delivery_tel' => $customer_mst->phone,
        'delivery_country' => 'India',
        'redirectUrl' => 'paymentget/payment-status',
        'cancelUrl' => 'paymentget/payment-cancel'        
    ];
      //print_r($parameters);exit;
      // gateway = CCAvenue / PayUMoney / EBS / Citrus / InstaMojo / ZapakPay / Mocker
      
      // $order = Indipay::gateway('CCAvenue')->prepare($parameters);
      // return Indipay::process($order);
    $order = Indipay::prepare($parameters);
    return Indipay::process($order);
    }

    public function checkout()
    {
      $home = new HomeController();
      $pending_inv=$home->getpendingInvoiceList();
      $headData = $home->deshboard_count(); 
      // echo "<pre>";
      // print_r($pending_inv);
      // exit;
      return view('user.checkout',compact('headData','pending_inv'));
    }
    public function pay_invlst_create()
    {
      $inputs = Input::all();
       $payments = [];
         echo"<pre>";      
      // print_r($inputs);
      // exit;
       // foreach ($inputs as $input) {
       //   // if(isset($input['checked']))
       //   // {
       //   //    print_r($input);exit;
       //   // }
       //    print_r($input);
       // } 

    $customer_mst=CustomerMasterModel::find(Auth::user()->id);
    $tid=time();
    $amount=$inputs['txtamount'];
    $batch_id=(PaymentGateway::max('batch_id')!==null?PaymentGateway::max('batch_id'):"0")+1;
//dd($customer_mst->id);

        foreach($inputs['rows'] as  $input)
          {
            if(!isset($input['checked'])) continue;

             // $payments[] = new PaymentGateway( array(
             //        'cust_id'=>$customer_mst->id,
             //        'asset_id'=>1,
             //        'batch_id'=>$batch_id,
             //        'customer_code'=>$customer_mst->customer_code,
             //        'inv_id'=>$input['invoice_id'],
             //        'tally_inv_no'=>$input['invoice'],
             //        'ledger_name'=>$customer_mst->fname,
             //        'account_name'=>$customer_mst->fname,
             //        'amount'=>$input['balance'],
             //        'date'=>now(),
             //        'tran_type' =>'Electronic',
             //        'pay_type' =>'inv',
             //    )); 

                    $gateway= new PaymentGateway();
                    $gateway->cust_id=$customer_mst->id;
                    $gateway->asset_id=1;
                    $gateway->batch_id=$batch_id;
                    $gateway->customer_code=$customer_mst->customer_code;
                    $gateway->inv_id=$input['invoice_id'];
                    $gateway->tally_inv_no=$input['invoice'];
                    $gateway->ledger_name=$customer_mst->fname;
                    $gateway->account_name=$customer_mst->fname;
                    $gateway->amount=$input['balance'];
                    $gateway->date=now();
                    $gateway->tran_type ='Electronic';
                    $gateway->pay_type ='inv';
                    $gateway->save();


          }
          //PaymentGateway::create($payments);
         
          $parameters = [
        'order_id' => $batch_id,
        'tid' => $tid,
        'amount' => $amount,
        'allow_repeated_payments' => 'true',
        'delivery_name' => $customer_mst->fname,
        'billing_email' => $customer_mst->email,
        'delivery_address' => $customer_mst->address,
        // 'billing_zip' => $inputs['pincode'],
        // 'billing_city' => $inputs['city'],
        // 'billing_state' => $inputs['state'],
        'delivery_tel' => $customer_mst->phone,
        'delivery_country' => 'India',
        'redirectUrl' => 'paymentget/payment-status',
        'cancelUrl' => 'paymentget/payment-cancel'        
    ];
      //print_r($parameters);exit;
      // gateway = CCAvenue / PayUMoney / EBS / Citrus / InstaMojo / ZapakPay / Mocker
      
      // $order = Indipay::gateway('CCAvenue')->prepare($parameters);
      // return Indipay::process($order);
    $order = Indipay::prepare($parameters);
    return Indipay::process($order);
      
    }



}
