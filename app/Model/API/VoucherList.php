<?php

namespace App\Model\API;

use Illuminate\Database\Eloquent\Model;

class VoucherList extends Model
{
    protected $table = 'voucher_lists';

    public function invoice()
    {
        return $this->hasOne(InvoiceMasters::class,'invoice_number','receiptno'); 
    }
}
