<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_roles', function (Blueprint $table) {
            $table->integer('user_id')->primary();
            $table->integer('role_id');
            $table->timestamps();
        });
        
        Schema::table('users_roles', function (Blueprint $table) {
            $table->index('user_id', 'user_id_index');
            $table->foreign('user_id')
                    ->references('id')->on('backend_users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
        
        \DB::table('users_roles')->insert(['user_id'=>1,'role_id'=>1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_roles');
    }
}
