<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->unique();
            $table->string('title', 140)->unique();
            $table->string('code', 45)->unique();
            $table->float('rating_cache',2,1)->default(3);
            $table->integer('rating_count')->default(0);
            $table->string('guarantee', 155);
            $table->longText('description');
            $table->decimal('price_usd',10,2);
            $table->decimal('price_uah',10,2)->nullable();
            $table->integer('amount');
            $table->boolean('active')->default(1);
            $table->integer('brand_id')->nullable();
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
        Schema::dropIfExists('products');
    }
}
