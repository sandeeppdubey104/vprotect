<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tally_guid',100)->nullable();
            $table->integer('cust_id')->unsigned()->index()->nullable();
            $table->foreign('cust_id')->references('id')->on('customer_master');
            $table->string('voucher_no'30)->nullable();
            $table->date('date');
            $table->string('trans_ledger',250)->nullable();
            $table->string('voucher_type',30);             
            $table->string('pay_mode',100)->nullable();
            $table->string('amount',30);
            $table->string('created_by',50);
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
        Schema::dropIfExists('vouchers');
    }
}
