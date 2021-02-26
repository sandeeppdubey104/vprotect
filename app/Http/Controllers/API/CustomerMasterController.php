<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\SendRegistrationEmailJob;
use App\Model\API\CustomerMasterModel;
use App\Model\API\SaleSubscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Mail;
use App\Mail\SendRegistrationEmail;

class CustomerMasterController extends Controller
{
   public function store(Request $request)
   { 

   	// $validator = Validator::make($request->all(), [
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required',
    //         'c_password' => 'required|same:password',
    //     ]); 

     // return response()->json(['success'=>$_POST]);
    
// $result="";
//     foreach($this->request->get('fname') as $key => $val){
//         // $rules['slide.'.$key.'.title'] = 'required|max:255';
//         // $rules['slide.'.$key.'.description'] = 'required|max:255';
//         $result.=$key;
//     }
      //dd($request->input()[0]['fname']);
// $result="";
$data = json_decode(file_get_contents("php://input")); 
//print_r($data) ;
// echo "<pre>";
// return response()->json($data);
// exit;
$result=1;
for ($i=0; $i < count($data) ; $i++) { 
   //print_r($data[$i])."<br/>" ;exit;
  // if(isset($data[$i]->customer_code) && isset($data[$i]->email)){

if (CustomerMasterModel::where('customer_code', '=', $data[$i]->customer_code)->exists()) {
    continue;
    }
    $CustomerMaster = new CustomerMasterModel();
    $CustomerMaster->fname=$data[$i]->fname;
    $CustomerMaster->lname=$data[$i]->lname;//.$CustomerMaster->count('id');
    $CustomerMaster->contact_name=$data[$i]->contact_name;
    $CustomerMaster->customer_code=$data[$i]->customer_code;
    $CustomerMaster->address=$data[$i]->address;
    $CustomerMaster->mobile=$data[$i]->mobile;
    $CustomerMaster->phone=$data[$i]->phone;
    $CustomerMaster->email=$data[$i]->email;
    $CustomerMaster->gstin=$data[$i]->gstin;
    $CustomerMaster->coach=$data[$i]->coach;
    $CustomerMaster->salesperson=$data[$i]->salesperson;
    $CustomerMaster->type=$data[$i]->type;
    $CustomerMaster->status=$data[$i]->status;
    $CustomerMaster->created_by=$data[$i]->created_by;
    $CustomerMaster->remarks=$data[$i]->remarks;
    $result = $CustomerMaster->save();
    $identity =$CustomerMaster->id;

    if(!$result)
    {  
    $result=0;  
    }

    $pass = "123";//str_random(10);
    $user = new User();
    $user->user_id=$identity;
    $user->name=$data[$i]->fname;
    $user->user_name=$data[$i]->customer_code;//$data[$i]->fname.''.$u;ser->count('id');
    //$invID = str_pad($invID, 4, '0', STR_PAD_LEFT);
    $user->password=Hash::make($pass);
    $user->mobile=$data[$i]->mobile;
    $user->email=$data[$i]->email;
    $user->address=$data[$i]->address;
    $result = $user->save();

$notification = array('name' =>$data[$i]->fname ,'mobile'=>$data[$i]->mobile,'email'=>$data[$i]->email,'customer_code'=>$data[$i]->customer_code,'pass'=>$pass ); 
 
 

    // $job=(new SendRegistrationEmailJob($notification))->delay(Carbon::now()->addSeconds(10));
    //  dispatch($job);

 //Mail::to('Sandeeppdubey104@gmail.com')->send(new SendRegistrationEmail($notification));

        $subsc =array($data[$i]->CustomerSubcription);
         // foreach ($data[$i]->CustomerSubcription as $subsc) {
             //print_r($subsc[0]);exit;
        $subs=new SaleSubscription();
        $subs->user_id=$identity;
        $subs->customer_code=$data[$i]->customer_code;
        $subs->product=isset($subsc[0]->product)?$subsc[0]->product:"";
        $subs->billing_type=$subsc[0]->billing_type;
        $subs->service_type=$subsc[0]->service_type;
        $subs->kit_type=$subsc[0]->kit_type;
        $subs->subs_valid_from=$subsc[0]->subs_valid_from!=""?$subsc[0]->subs_valid_from:date('Y-m-d');
        $subs->subs_valid_to=$subsc[0]->subs_valid_to!=""?$subsc[0]->subs_valid_to:date('Y-m-d');
        $subs->extra_valid_days="0";
        $subs->price=$subsc[0]->price;
        $subs->status="1";
        $result = $subs->save();
             
         // }

   //}
 }

 if(!$result)
     {   
      return response()->json(['error'=>'Unauthorised'.$result], 401);      
     }
     else
     {
      return response()->json(['success'=>"Success"]);
     }
  
		
   }
}

