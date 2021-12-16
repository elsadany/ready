<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->integer('shop_id');
            $table->integer('address_id')->nullable();
            $table->integer('tracking_status');
            $table->double('price');
            $table->tinyInteger('is_paied')->default(0);
            $table->string('payment_id', 255)->nullable();
            $table->integer('status')->default(0);
            $table->integer('payment_type');
            $table->integer('branch_id');
            $table->timestamps();
            $table->text('address_data')->nullable();
            $table->string('mobile', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
