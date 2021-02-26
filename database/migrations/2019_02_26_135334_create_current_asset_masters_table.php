<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentAssetMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current_asset_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_name',100);
            $table->string('account_under',100);
            $table->string('bank_acc_holder',100);
            $table->string('bank_branch',100);
            $table->string('bank_ifsc',100);
            $table->string('bank_acc_no',100);
            $table->text('bank_address',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('current_asset_masters');
    }
}
