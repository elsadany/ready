<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMenuAddsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_adds', function (Blueprint $table) {
            $table->foreign('menu_id', 'menu_adds_ibfk_1')->references('id')->on('menus')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_adds', function (Blueprint $table) {
            $table->dropForeign('menu_adds_ibfk_1');
        });
    }
}
