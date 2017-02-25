<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('order_items', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('quantity')->unsigned()->default(1);
            $table->integer('product_id');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('order_items');
    }

}
