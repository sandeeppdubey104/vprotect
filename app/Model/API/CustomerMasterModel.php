<?php

namespace App\Model\API;

use Illuminate\Database\Eloquent\Model;

class CustomerMasterModel extends Model
{
	
     protected $table = 'customer_master';
     

     public function subscription()
    {
        //return $this->hasMany('App\Models\API\SaleSubscription','customer_code','customer_code');
         return $this->belongsTo(SaleSubscription::class);
         //->select(array('id', 'first_name', 'last_name'));  //can specify coloun name
    }
}
