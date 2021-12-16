<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('shop_id')->index('shop_id');
            $table->integer('category_id')->index('category_id');
            $table->double('price')->nullable();
            $table->tinyInteger('has_chooses')->default(0);
            $table->tinyInteger('avilability')->default(1);
            $table->string('image', 255);
            $table->tinyInteger('approved')->default(0);
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
        Schema::dropIfExists('menus');
    }
}
