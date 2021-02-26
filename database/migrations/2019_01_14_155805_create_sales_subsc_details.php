<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesSubscDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_subsc_details', function (Blueprint $table) {
                $table->increments('id');    
                $table->integer('user_id');        
                $table->string('customer_code',100); 
                $table->string('product',250);
                $table->string('billing_type'); 
                $table->string('service_type');
                $table->string('kit_type');
                $table->date('subs_valid_from'); 
                $table->date('subs_valid_to'); 
                $table->integer('extra_valid_days');  
                $table->string('price'); //$table->decimal('price',18,2);  
                $table->integer('status');           
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
        Schema::dropIfExists('sales_subsc_details');
    }
}
