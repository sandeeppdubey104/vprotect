<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    //

    public function asset_dt()
    {
        return $this->hasOne('App\Model\CurrentAssetMaster','id','asset_id');
    }
}
