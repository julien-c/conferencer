<?php
use Illuminate\Database\Migrations\Migration;

class ConferencerCreateTalksTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('talks', function($table) {
			$table->increments('id');
				$table->string('name');
				$table->string('slug');
				$table->string('subname');
				$table->string('image');
				$table->text('description');
				$table->text('links');

				$table->string('youtube');
				$table->integer('youtube_views')->default(0);
				$table->string('flickr');

				$table->dateTime('from');
				$table->dateTime('to');
			$table->integer('category_id');
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
		Schema::drop('talks');
	}

}
