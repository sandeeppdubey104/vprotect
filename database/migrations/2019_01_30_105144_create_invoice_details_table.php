<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('main_id')->unsigned()->index()->nullable();
            $table->foreign('main_id')->references('id')->on('invoice_masters');
            $table->string('itemname',100)->nullable();
            $table->string('qty',100)->nullable();
            $table->string('rate',100)->nullable();
            $table->string('discount',100)->nullable();
            $table->string('amount',100)->nullable();
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
        Schema::dropIfExists('invoice_details');
    }
}
