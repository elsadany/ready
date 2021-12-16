<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsCategoryLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs_category_langs', function (Blueprint $table) {
            $table->integer('id',true);
            $table->string('title');
            $table->integer('faqs_category_id');
            $table->integer('lang_id');
            $table->timestamps();
        });
         Schema::table('faqs_category_langs', function (Blueprint $table) {
            $table->foreign('faqs_category_id', 'faqs_category_langs_ibfk_1')->references('id')->on('faqs_categories')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
        Schema::table('faqs_category_langs', function (Blueprint $table) {
            $table->foreign('lang_id', 'faqs_category_langs_ibfk_2')->references('id')->on('languages')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faqs_category_langs');
    }
}
