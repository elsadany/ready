<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->integer('id', true);
            $table->bigInteger('user_id')->index('addresses_ibfk_1');
            $table->integer('location_id')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('street', 255);
            $table->integer('bulding_number');
            $table->integer('floar_number')->nullable();
            $table->string('details', 500);
            $table->float('lat', 10, 0)->nullable();
            $table->float('lng', 10, 0)->nullable();
            $table->string('mobile', 50);
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
        Schema::dropIfExists('addresses');
    }
}
