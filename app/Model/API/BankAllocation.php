<?php

namespace App\Model\API;

use Illuminate\Database\Eloquent\Model;

class BankAllocation extends Model
{
	protected $table = 'bank_allocations';
    //

    public function invoice()
    {
        return $this->belongsTo('App\Model\API\Vouchers');
    }
}
