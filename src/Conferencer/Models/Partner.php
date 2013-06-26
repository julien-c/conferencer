<?php
namespace Conferencer\Models;

/**
 * A partner or sponsor for the conferencer
 */
class Partner extends BaseModel
{

	/**
	 * The validation rules
	 *
	 * @var array
	 */
	public static $rules = array(
		'name' => 'required',
		'type' => 'required',
	);

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'partners';

	/**
	 * Path to the Speaker images
	 *
	 * @var string
	 */
	public static $images = 'app/img/partners/';

}
