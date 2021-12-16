<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->integer('id',true);
            $table->integer('rate')->default(0)->nullable();
            $table->text('comment')->nullable();
            $table->biginteger('user_id');
            $table->integer('shop_id');
            $table->timestamps();
        });
         Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('shop_id', 'reviews_ibfk_1')->references('id')->on('shops')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
