<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cust_id')->unsigned()->index()->nullable();
            $table->integer('asset_id')->default('1')->unsigned()->index()->nullable();
            $table->integer('batch_id');
            $table->string('customer_code')->nullable();
            $table->string('inv_id')->nullable();
            $table->string('tally_inv_no')->nullable();
            $table->string('ledger_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('amount')->nullable();
            $table->string('tran_type')->default('Online Payment')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('tran_number')->nullable();
            $table->string('trans_remarks')->nullable();
            $table->integer('payment_status')->default('0')->nullable(); 
            $table->string('bank_ref_no')->nullable();
            $table->string('trans_date',40)->nullable();
            $table->string('pay_type',5)->default('inv')->nullable();//inv/adv
            $table->timestamp('date')->nullable();
            $table->string('is_synced')->default('0')->nullable();
            $table->timestamp('synced_date')->nullable();
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
        Schema::dropIfExists('payment_gateways');
    }
}
