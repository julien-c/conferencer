<?php
namespace Conferencer\Models;

use Illuminate\Support\Collection;

class Tag extends BaseModel
{

	/**
	 * The validation rules
	 *
	 * @var array
	 */
	public static $rules = array(
		'name' => 'required',
	);

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'tags';

	////////////////////////////////////////////////////////////////////
	//////////////////////////// RELATIONSHIPS /////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Get all Talks that has this Tag
	 *
	 * @return Collection
	 */
	public function talks()
	{
		return $this->belongsToMany('Talk');
	}

	/**
	 * Get all the Speakers who have Talks with this Tag
	 *
	 * @return Collection
	 */
	public function speakers()
	{
		$speakers = array();
		foreach ($this->talks as $talk) {
			$speakers += $talk->speakers->all();
		}

		return new Collection(array_unique($speakers));
	}

	////////////////////////////////////////////////////////////////////
	///////////////////////////// ATTRIBUTES ///////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * String representation
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->name;
	}

}
