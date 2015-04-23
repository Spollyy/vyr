<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->char('name', 60);
			$table->char('file', 50);
			$table->decimal('rating', 5,1);
			$table->integer('save');
			$table->integer('being_saved');
			$table->char('login', 20)->unique();
			$table->char('phone',11);
			$table->char('add_phone',11);
			$table->char('adress',60);
			$table->char('pwd',60);
			$table->char('email', 30)->unique;
			$table->boolean('notification1');
		});
		Schema::create('seo', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->char('title', 200);
			$table->text('description');
			$table->text('keywords');
		});
		Schema::create('group', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->char('name', 60);
			$table->char('file', 50);
			$table->text('description');

		});
		Schema::create('message', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->text('message');
			$table->integer('to')->unsigned();
			$table->integer('from')->unsigned();
		});
		Schema::create('usergroup', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->integer('group_id')->unsigned();

		});
		Schema::create('friends', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->integer('friend_id')->unsigned();

		});
		Schema::create('referance', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->text('referance');
			$table->integer('author_id')->unsigned();
			$table->integer('user_id')->unsigned();

		});
		Schema::create('feedback', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->text('feedback');
			$table->integer('author_id')->unsigned();

		});
		Schema::create('complaint', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->text('complaint');
			$table->integer('author_id')->unsigned();
		});
		Schema::create('alert', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('author_id')->unsigned();
			$table->string('coords', 100);

		});

		Schema::table('message', function($table)
		{
			$table->foreign('from')->references('id')->on('users');
			$table->foreign('to')->references('id')->on('users');
		});

		Schema::table('usergroup', function($table)
		{
			$table->foreign('group_id')->references('id')->on('users');
			$table->foreign('user_id')->references('id')->on('users');
		});

		Schema::table('friends', function($table)
		{
			$table->foreign('friend_id')->references('id')->on('users');
			$table->foreign('user_id')->references('id')->on('users');
		});

		Schema::table('referance', function($table)
		{
			$table->foreign('author_id')->references('id')->on('users');
			$table->foreign('user_id')->references('id')->on('users');
		});

		Schema::table('complaint', function($table)
		{
			$table->foreign('author_id')->references('id')->on('users');
		});

		Schema::table('feedback', function($table)
		{
			$table->foreign('author_id')->references('id')->on('users');
		});

		Schema::table('alert', function($table)
		{
			$table->foreign('author_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
		Schema::drop('seo');
		Schema::drop('usergroup');
		Schema::drop('group');
		Schema::drop('message');
		Schema::drop('friends');
		Schema::drop('referance');
		Schema::drop('feedback');
		Schema::drop('complaint');
		Schema::drop('alert');
	}

}
