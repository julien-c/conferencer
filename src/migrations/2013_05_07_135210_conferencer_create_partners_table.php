<?php
use Illuminate\Database\Migrations\Migration;

class ConferencerCreatePartnersTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('partners', function($table) {
			$table->increments('id');
				$table->string('name');
				$table->text('description');
				$table->string('type');
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
		Schema::drop('partners');
	}

}
