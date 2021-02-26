<?php

namespace App\Model\API;

use Illuminate\Database\Eloquent\Model;

class InvoiceMasters extends Model
{
    //
 	protected $table = 'invoice_masters';

    public function customer()
    {
    	return $this->hasOne('App\Model\API\CustomerMasterModel','id','customer_id');
    }

    public function ledgers()
    {
    	return $this->hasMany('App\Model\API\Ledgers','main_id','id');
    }

    public function receipt()
    {
    	return $this->hasMany('App\Model\API\Receipts','inv_id','id');
    }

    public function items()
    {
    	return $this->hasMany('App\Model\API\InvoiceDetails','main_id','id');
    }

}
