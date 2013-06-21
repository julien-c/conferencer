<?php
use Illuminate\Database\Migrations\Migration;

class ConferencerCreateSpeakersTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('speakers', function($table) {
			$table->increments('id');
				$table->string('name');
				$table->string('slug');
				$table->string('role');
				$table->string('biography');
				$table->string('website');
				$table->string('twitter');
				$table->string('facebook');
				$table->string('image');
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
		Schema::drop('speakers');
	}

}
