<?php
namespace Conferencer\Models;

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

	////////////////////////////////////////////////////////////////////
	///////////////////////////// ATTRIBUTES ///////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Get the Partner's image as a tag
	 *
	 * @return string
	 */
	public function getImagePathAttribute()
	{
		return 'app/img/partners/'.$this->image;
	}

}
