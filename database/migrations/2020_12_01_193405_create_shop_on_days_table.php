<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopOnDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_on_days', function (Blueprint $table) {
            $table->integer('id',true);
            $table->integer('shop_id');
            $table->integer('day');
            $table->boolean('is_open')->default(0)->nullable();
            $table->time('open_at')->nullable();
            $table->time('close_at')->nullable();
            $table->timestamps();
        });
         Schema::table('shop_on_days', function (Blueprint $table) {
            $table->foreign('shop_id', 'shop_on_days_ibfk_1')->references('id')->on('shops')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_on_days');
    }
}
