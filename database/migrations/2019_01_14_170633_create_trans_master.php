<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trans_master', function (Blueprint $table) {
            $table->increments('id');
             $table->string('trans_no',20);
             $table->decimal('amount');
             $table->date('date');
             $table->string('mode',20);
             $table->string('invoice_number',20);             
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
        Schema::dropIfExists('trans_master');
    }
}
