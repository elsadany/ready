<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_branches', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('branch_id');
        
        });
         Schema::table('offer_branches', function (Blueprint $table) {
            $table->foreign('branch_id', 'offer_branches_ibfk_1')->references('id')->on('branches')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('id', 'offer_branches_ibfk_2')->references('id')->on('offers')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_branches');
    }
}
