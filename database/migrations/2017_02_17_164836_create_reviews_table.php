<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('product_id')->nullable(false);
            $table->integer('user_id')->nullable(false);
            $table->integer('rating')->nullable(false);
            $table->text('comment')->nullable(false);
            $table->tinyInteger('approved')->unsigned()->default(0);
            $table->tinyInteger('spam')->unsigned()->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
