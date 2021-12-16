<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMenuChooseLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_choose_langs', function (Blueprint $table) {
            $table->foreign('choose_id', 'menu_choose_langs_ibfk_1')->references('id')->on('menu_chooses')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_choose_langs', function (Blueprint $table) {
            $table->dropForeign('menu_choose_langs_ibfk_1');
        });
    }
}
