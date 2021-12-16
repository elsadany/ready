<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTagsAttribute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops_tags', function (Blueprint $table) {
            $table->integer('shop_id');
            $table->biginteger('general_tag_id')->unsigned();
        });
         Schema::table('shops_tags', function (Blueprint $table) {
            $table->foreign('shop_id', 'shops_tags_ibfk_1')->references('id')->on('shops')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
         Schema::table('shops_tags', function (Blueprint $table) {
            $table->foreign('general_tag_id', 'shops_tags_ibfk_2')->references('id')->on('general_tags')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops_tags');
    }
}
