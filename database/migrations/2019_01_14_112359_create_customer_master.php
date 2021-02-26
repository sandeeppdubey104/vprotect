<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_master', function (Blueprint $table) {
                $table->increments('id');
                $table->string('fname',100);
                $table->string('lname',100)->nullable();
                $table->string('contact_name',100)->nullable();
                $table->string('customer_code',100)->nullable();
                $table->text('address')->nullable();
                $table->string('mobile',50)->nullable();
                $table->string('phone',50)->nullable();
                $table->string('email')->nullable();
                $table->string('gstin',20)->nullable();
                $table->string('coach',100)->nullable();
                $table->string('salesperson',100)->nullable();
                $table->string('type',100)->nullable();
                $table->integer('status')->nullable();
                $table->string('created_by',100)->nullable();
                $table->string('remarks',255)->nullable();
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
        Schema::dropIfExists('customer_master');
    }
}
