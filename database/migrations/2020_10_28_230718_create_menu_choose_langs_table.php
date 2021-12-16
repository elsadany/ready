<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuChooseLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_choose_langs', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('choose_id')->index('choose_id');
            $table->string('name', 255);
            $table->integer('lang_id')->index('lang_id');
            $table->dateTime('created_at');
            $table->dateTime('update_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_choose_langs');
    }
}
