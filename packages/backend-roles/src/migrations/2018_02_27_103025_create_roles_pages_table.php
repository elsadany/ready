<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_pages', function (Blueprint $table) {
            $table->integer('id',true);
            $table->integer('role_id');
            $table->integer('page_id');
            $table->timestamps();
        });
        
        Schema::table('roles_pages', function (Blueprint $table) {
            $table->index('role_id', 'role_id_index');
            $table->foreign('role_id')
                    ->references('id')->on('roles')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            
            $table->index('page_id', 'page_id_index');
            $table->foreign('page_id')
                    ->references('id')->on('pages')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_pages');
    }
}
