<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers_notifications', function (Blueprint $table) {
            $table->integer('id',true);
            $table->integer('shop_id');
            $table->timestamps();
        });
         Schema::table('offers_notifications', function (Blueprint $table) {
            $table->foreign('shop_id', 'offers_notifications_ibfk_1')->references('id')->on('shops')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers_notification');
    }
}
