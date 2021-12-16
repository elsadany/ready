<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_menus', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('menu_id');
        
        });
          Schema::table('offer_menus', function (Blueprint $table) {
            $table->foreign('menu_id', 'offer_menus_ibfk_1')->references('id')->on('menus')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('id', 'offer_menus_ibfk_2')->references('id')->on('offers')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_menus');
    }
}
