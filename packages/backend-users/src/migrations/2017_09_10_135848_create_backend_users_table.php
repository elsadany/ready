<?php

use Illuminate\Support\Facades\Hash;
use ElsayedNofal\BackendUsers\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBackendUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('backend_users', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name');
			$table->string('email')->unique('email');
			$table->string('password');
			$table->string('phone', 20)->nullable();
			$table->string('remember_token')->nullable();
			$table->string('image')->nullable();
			$table->boolean('is_active')->default(1);
			$table->integer('created_by')->nullable();
			$table->string('reset_password_token')->nullable();
			$table->dateTime('reset_password_at')->nullable();
			$table->timestamps();
		});

		$users= User::all();
		if(count($users)==0){
			DB::table('backend_users')->insert([
				'name'=>'admin',
				'email'=>'admin@backend.com',
				'password'=>Hash::make('12345678'),
				'is_active'=>true
			]);
		}


	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('backend_users');
	}

}
