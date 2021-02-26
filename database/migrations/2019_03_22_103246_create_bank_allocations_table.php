<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_allocations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('main_id')->unsigned()->index()->nullable();
            $table->foreign('main_id')->references('id')->on('vouchers');
            $table->string('main_voucher_id',30)->nullable();
            $table->date('bankalocationdate')->nullable();
            $table->date('instrumentdate')->nullable();
            $table->string('transactiontype',30)->nullable();
            $table->string('transactionmode',30)->nullable();
            $table->string('bankname',100)->nullable();
            $table->string('paymentfavouring',100)->nullable();
            $table->string('instrumentnumber',50)->nullable();
            $table->string('uniquereferencenumber',50)->nullable();
            $table->string('paymentmode',50)->nullable();
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
        Schema::dropIfExists('bank_allocations');
    }
}
