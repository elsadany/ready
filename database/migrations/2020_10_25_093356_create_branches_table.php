<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->integer('id',true);
            $table->integer('shop_id')->index('shop_id');
            $table->double('lat');
            $table->double('lng');
            $table->integer('delivery_distance')->default(5);
            $table->string('name', 255);
            $table->integer('status')->comment('1 open , 0 closed');
            $table->text('time');
            $table->timestamps();
            $table->tinyInteger('approved')->default(0);
            $table->string('address',255)->nullbale();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches');
    }
}
