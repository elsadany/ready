<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMenuAddLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_add_langs', function (Blueprint $table) {
            $table->foreign('add_id', 'menu_add_langs_ibfk_1')->references('id')->on('menu_adds')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_add_langs', function (Blueprint $table) {
            $table->dropForeign('menu_add_langs_ibfk_1');
        });
    }
}
