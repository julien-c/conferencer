<?php
namespace Conferencer\Models;

use Illuminate\Support\Collection;
use DB;

class Speaker extends BaseModel
{

	/**
	 * Path to the Speaker images
	 *
	 * @var string
	 */
	public static $images = 'app/img/speakers/';

	/**
	 * Model validation rules
	 *
	 * @var array
	 */
	public static $rules = array(
		'name'      => 'required',
		'role'      => 'required',
		'biography' => 'required',
	);

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'speakers';

	////////////////////////////////////////////////////////////////////
	//////////////////////////// RELATIONSHIPS /////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Get the Speaker's Talks
	 */
	public function talks()
	{
		return $this->belongsToMany('Talk')->orderBy('from', 'asc');
	}

	/**
	 * Get all the Tags in the Speaker's Talks
	 *
	 * @return array
	 */
	public function tags()
	{
		$tags = array();
		foreach ($this->talks as $talk) {
			$tags += $talk->tags->all();
		}

		return new Collection(array_unique($tags));
	}

	/**
	 * Get all Speakers related to this one
	 *
	 * @return Collection
	 */
	public function relatedSpeakers()
	{
		// Get the talks from this speaker, find the other speakers of these talks
		$talks    = array_pluck($this->talks->all(), 'id');
		$speakers = DB::table('speaker_talk')->whereIn('talk_id', $talks)->lists('speaker_id');
		$speakers = array_unique($speakers);

		// Get all the speakers
		unset($speakers[array_search($this->id, $speakers)]);
		$speakers = Speaker::whereIn('id', array_unique($speakers))->get();

		return $speakers;
	}

	////////////////////////////////////////////////////////////////////
	////////////////////////////// ATTRIBUTES //////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Get the Speaker's contact informations
	 *
	 * @return  array
	 */
	public function getContactAttribute()
	{
		$contact = array();

		// Add website
		if ($this->website) {
			$contact['website'] = $this->website;
		}

		// Add Facebook
		if ($this->facebook) {
			$contact['facebook'] = 'http://www.facebook.com/'.$this->facebook;
		}

		// Add Twitter
		if ($this->twitter) {
			$contact['twitter'] = 'http://twitter.com/'.substr($this->twitter, 1);
		}

		return $contact;
	}

}
