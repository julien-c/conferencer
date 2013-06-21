<?php
use Illuminate\Database\Migrations\Migration;

class ConferencerCreateTagTalkTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tag_talk', function($table) {
			$table->increments('id');
				$table->integer('tag_id');
				$table->integer('talk_id');
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
		Schema::drop('tag_talk');
	}

}
