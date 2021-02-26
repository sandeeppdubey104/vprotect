<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnRegisterPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('un_register_payments', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('asset_id')->default('1')->unsigned()->index()->nullable();
            $table->string('ledger_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('amount')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();  
            $table->string('tran_type')->default('Online Payment')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('tran_number')->nullable();
            $table->string('trans_remarks')->nullable();
            $table->integer('payment_status')->default('0')->nullable(); 
            $table->string('bank_ref_no')->nullable();
            $table->string('trans_date',40)->nullable();
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
        Schema::dropIfExists('un_register_payments');
    }
}
