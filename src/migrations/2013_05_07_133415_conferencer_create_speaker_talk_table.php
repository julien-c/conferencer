<?php
use Illuminate\Database\Migrations\Migration;

class ConferencerCreateSpeakerTalkTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('speaker_talk', function($table) {
			$table->increments('id');
				$table->integer('talk_id');
				$table->integer('speaker_id');
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
		Schema::drop('speaker_talk');
	}

}
