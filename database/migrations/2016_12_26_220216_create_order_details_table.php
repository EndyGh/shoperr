<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('order_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('city');
            $table->string('phone');
            $table->string('shipping-address');
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
        Schema::dropIfExists('order_details');
    }
}
