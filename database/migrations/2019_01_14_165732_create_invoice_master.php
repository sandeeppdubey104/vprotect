<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_masters', function (Blueprint $table) {
                $table->increments('id');
                $table->string('order_id',20)->nullable();
                $table->string('invoice_number',20)->nullable();
        $table->string('customer_id',20)->nullable()->references('fname')->on('customer_master');
                $table->date('date')->nullable();
                $table->date('due_date')->nullable();
                $table->string('voucher_type',200)->nullable();
                $table->string('refrence',200)->nullable();
                $table->string('partyname',200)->nullable();
                $table->string('partyledgername',200)->nullable();
                $table->text('buyeraddress')->nullable();
                $table->text('salesperson')->nullable();
                $table->text('tax_type')->nullable();
                $table->text('tax_rate')->nullable();
                $table->decimal('total_amount',18,2)->nullable();
                
                $table->string('delivery_note',50)->nullable(); 
                $table->string('sales_order',50)->nullable(); 
                $table->string('pay_mode',50)->nullable();
                $table->string('pay_appr_code',50)->nullable();
                $table->date('cont_from')->nullable();
                 $table->date('cont_to')->nullable();
                 $table->string('kit_type',50)->nullable();
                //$table->foreign('customer_id');
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
        Schema::dropIfExists('invoice_masters');
    }
}
