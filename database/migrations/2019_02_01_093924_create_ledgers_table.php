<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('main_id')->unsigned()->index()->nullable();
            $table->foreign('main_id')->references('id')->on('invoice_masters');
            $table->string('type',20);
            $table->string('ledgername',200);
             $table->string('rate',20)->nullable();
            $table->decimal('amount',15,2);
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
        Schema::dropIfExists('ledgers');
    }
}
