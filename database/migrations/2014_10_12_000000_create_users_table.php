<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
             $table->integer('user_id');
            $table->string('user_name');
             $table->string('password');
             $table->string('mobile',50);
            $table->string('email')->nullable();            
            $table->timestamp('email_verified_at')->nullable();
            $table->string('emp_code')->nullable();
            $table->string('designation')->nullable();
            $table->text('address')->nullable();
             $table->string('image')->nullable();
            $table->string('user_type')->default('user');
            $table->string('designation_hierarchy')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
