<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersNotificationLangsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('offers_notification_langs', function (Blueprint $table) {
            $table->integer('id', true);

            $table->integer('offers_notification_id');
            $table->string('title');
            $table->string('description');
            $table->integer('lang_id');
            $table->timestamps();
        });
         Schema::table('offers_notification_langs', function (Blueprint $table) {
            $table->foreign('offers_notification_id', 'offers_notification_langs_ibfk_1')->references('id')->on('offers_notifications')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
         Schema::table('offers_notification_langs', function (Blueprint $table) {
            $table->foreign('lang_id', 'offers_notification_langs_ibfk_2')->references('id')->on('languages')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('offers_notification_langs');
    }

}
