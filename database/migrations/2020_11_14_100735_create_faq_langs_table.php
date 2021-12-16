<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_langs', function (Blueprint $table) {
            $table->integer('id',TRUE);
            $table->string('question',255);
            $table->text('answer');
            $table->integer('faq_id');
            $table->integer('lang_id');
            $table->timestamps();
        });
        Schema::table('faq_langs', function (Blueprint $table) {
            $table->foreign('faq_id', 'faq_langs_ibfk_1')->references('id')->on('faqs')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
        Schema::table('faq_langs', function (Blueprint $table) {
            $table->foreign('lang_id', 'faq_langs_ibfk_2')->references('id')->on('languages')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_langs');
    }
}
