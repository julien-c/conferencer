<?php
namespace Conferencer\Models;

class Article extends BaseModel
{

	/**
	 * Model validation rules
	 *
	 * @var array
	 */
	public static $rules = array(
		'name'    => 'required',
		'content' => 'required',
	);

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'articles';

	////////////////////////////////////////////////////////////////////
	//////////////////////////// RELATIONSHIPS /////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Get the Article's author
	 *
	 * @return User
	 */
	public function user()
	{
		return $this->belongsTo('User');
	}

}
