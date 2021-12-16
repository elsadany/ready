<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->integer('id',true);
            $table->integer('category_id')->index('category_id');
            $table->string('logo', 255);
            $table->integer('min_order')->default(0);
            $table->integer('dlivary_rime');
            $table->text('cuisine_id')->nullable();
            $table->string('cover_photo', 255);
            $table->double('rate')->default(5);
            $table->integer('created_by')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
