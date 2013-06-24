<?php
namespace Conferencer\Models;

use Eloquent;
use File;
use Illuminage\Facades\Illuminage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

/**
 * A base model to share common methods and helpers
 * across Conferencer's models
 */
class BaseModel extends Eloquent
{

	/**
	 * Base model validation rules
	 *
	 * @var array
	 */
	public static $rules = array(
		'name' => 'required',
	);

	////////////////////////////////////////////////////////////////////
	///////////////////////////// ATTRIBUTES ///////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Get a striped version of an attribute
	 *
	 * @param  string  $attribute
	 * @param  integer $words
	 *
	 * @return string
	 */
	public function getStripedAttribute($attribute, $words = 25)
	{
		$attribute = Str::words($this->$attribute, $words);

		return strip_tags($attribute);
	}

	/**
	 * Change both the name and the slug of a Speaker
	 *
	 * @param string $name
	 */
	public function setNameAttribute($name)
	{
		$this->attributes['name'] = $name;
		if (!$this instanceof Tag and !$this instanceof Partner) {
			$this->attributes['slug'] = Str::slug($name);
		}
	}

	/**
	 * Get the date of the model
	 *
	 * @return string
	 */
	public function getDateAttribute()
	{
		return $this->created_at->toDateString();
	}

	/**
	 * Get the time of the model
	 *
	 * @return string
	 */
	public function getTimeAttribute()
	{
		return $this->created_at->format('H:i');
	}

	/**
	 * Get full path to the model's image
	 *
	 * @return string
	 */
	public function getImagePathAttribute()
	{
		if (!$this->image) return false;

		$image = static::$images.$this->image;
		if (!File::exists($image)) $image = static::$images.'fixtures/'.$this->image;
		if (!File::exists($image)) return false;

		return $image;
	}

	/**
	 * Get a thumb for the model's image
	 *
	 * @return Image
	 */
	public function thumb($width = 200, $height = null)
	{
		if (!$height) $height = $width;

		// Fallback
		if (!$this->imagePath) {
			return new \HtmlObject\Image($this->image);
		}

		return Illuminage::thumb($this->imagePath, $width, $height);
	}

	/**
	 * String representation
	 *
	 * @return string
	 */
	public function __toString()
	{
		return $this->name;
	}

	////////////////////////////////////////////////////////////////////
	////////////////////////////// HELPERS /////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Find a model by its slug or fail if not found
	 *
	 * @param string $slug
	 *
	 * @return Eloquent
	 */
	public static function slugOrFail($slug)
	{
		if (!is_null($model = static::whereSlug($slug)->first())) {
			return $model;
		}

		throw new ModelNotFoundException;
	}

}
