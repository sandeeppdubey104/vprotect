<?php

namespace App\Model\API;

use Illuminate\Database\Eloquent\Model;

class SaleSubscription extends Model
{
    protected $table = 'sales_subsc_details';

     public function customer()
    {
    	 //return $this->belongsTo(CustomerMasterModel::class);
    	return $this->hasOne(CustomerMasterModel::class,'id','user_id');
    	//->select(array('id', 'fname'));
       // return $this->hasOne('App\Models\API\CustomerMasterModel');
    }
     public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

}
