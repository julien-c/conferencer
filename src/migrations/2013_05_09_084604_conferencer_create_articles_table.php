<?php
use Illuminate\Database\Migrations\Migration;

class ConferencerCreateArticlesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function($table) {
			$table->increments('id');
				$table->string('name');
				$table->string('slug');
				$table->text('content');
				$table->integer('user_id');
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
		Schema::drop('articles');
	}

}
