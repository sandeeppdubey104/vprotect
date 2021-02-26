<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_master', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('code',100);
             $table->string('brand',100);
             $table->string('description',255);
             $table->decimal('price',18,2);
             $table->integer('quantity');
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
        Schema::dropIfExists('product_master');
    }
}
