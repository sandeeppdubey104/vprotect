<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('voucher_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vouchers_id')->unsigned()->index()->nullable();
            $table->foreign('vouchers_id')->references('id')->on('vouchers');
            $table->integer('inv_id')->unsigned()->index()->nullable();
            $table->foreign('inv_id')->references('id')->on('invoice_masters');
           
            $table->string('receiptno',30);
            $table->string('billtype',30);
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
        Schema::dropIfExists('voucher_lists');
    }
}
