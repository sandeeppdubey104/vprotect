<?php

namespace App\Model\API;

use Illuminate\Database\Eloquent\Model;

class Receipts extends Model
{
    //

    public function invoice()
    {
        return $this->belongsTo('App\Model\API\InvoiceMasters');
    }
}
