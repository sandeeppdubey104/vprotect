<?php

namespace App\Model\API;

use Illuminate\Database\Eloquent\Model;

class Vouchers extends Model
{
     protected $table = 'vouchers';

     public function voucher_list()
    {
    	return $this->hasMany('App\Model\API\VoucherList');
    }

    public function bankallocation()
    {
    	return $this->hasMany('App\Model\API\BankAllocation','main_voucher_id','voucher_no');
    }
}
