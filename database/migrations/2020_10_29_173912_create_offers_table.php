<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->integer('id',true);
            $table->integer('shop_id');
            $table->integer('offer_type')->comment='0=precent 1=fixed';
            $table->double('min_order')->nullable()->default(0);
            $table->double('max_order')->nullable();
            $table->boolean('all_menu')->nullable()->default(0);
            $table->boolean('all_branches')->nullable()->default(0);
            $table->date('date_from');
            $table->date('date_to');
            $table->boolean('is_confirmed')->nullable()->default(0);
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
        Schema::dropIfExists('offers');
    }
}
