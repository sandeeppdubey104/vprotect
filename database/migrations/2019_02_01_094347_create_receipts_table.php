<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('main_id')->unsigned()->index()->nullable();
            $table->foreign('main_id')->references('id')->on('vouchers');
             $table->integer('inv_id')->unsigned()->index()->nullable();
            $table->foreign('inv_id')->references('id')->on('invoice_masters');
            $table->string('main_voucher_id',30)->nullable();
            $table->string('receiptno',30);
            $table->string('billtype',30);
            $table->string('pay_source',30)->default('inv')->nullable();//inv/voucher
            $table->string('amount',30);
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
        Schema::dropIfExists('receipts');
    }
}
