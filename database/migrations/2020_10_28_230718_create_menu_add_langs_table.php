<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuAddLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_add_langs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('add_id')->index('add_id');
            $table->integer('lang_id')->index('lang_id');
            $table->string('name', 255);
            $table->string('desc', 255)->nullable();
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
        Schema::dropIfExists('menu_add_langs');
    }
}
