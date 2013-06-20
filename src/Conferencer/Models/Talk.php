<?php
namespace Conferencer\Models;

class Talk extends BaseModel
{

	/**
	 * Path to the Talks images
	 *
	 * @var string
	 */
	public static $images = 'app/img/talks/';

	/**
	 * Model validation rules
	 *
	 * @var array
	 */
	public static $rules = array(
		'name' => 'required',
		'from' => 'required',
	);

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'talks';

	////////////////////////////////////////////////////////////////////
	//////////////////////////// RELATIONSHIPS /////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Get all the Speakers at a Talk
	 *
	 * @return  Collection
	 */
	public function speakers()
	{
		return $this->belongsToMany('Speaker');
	}

	/**
	 * Get all the tags of a Talk
	 *
	 * @return  Collection
	 */
	public function tags()
	{
		return $this->belongsToMany('Tag');
	}

	/**
	 * Get all the talks happening the same day
	 *
	 * @return  Collection
	 */
	public function relatedTalks()
	{
		$day = $this->from->format('Y-m-d');

		return static::where('from', 'LIKE', $day.'%')->orderBy('from', 'ASC')->get();
	}

	////////////////////////////////////////////////////////////////////
	///////////////////////////// ATTRIBUTES ///////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Get the date of the model
	 *
	 * @return string
	 */
	public function getDateAttribute()
	{
		return $this->from->toDateString();
	}

	/**
	 * Get the time of the model
	 *
	 * @return string
	 */
	public function getTimeAttribute()
	{
		return $this->from->format('H:i');
	}

	/**
	 * Get the attributes that should be converted to dates.
	 *
	 * @return array
	 */
	public function getDates()
	{
		return array('from', 'to', static::CREATED_AT, static::UPDATED_AT, static::DELETED_AT);
	}

	/**
	 * Check if the provided Youtube field is a video or a playlist
	 *
	 * @return boolean
	 */
	public function getHasYoutubePlaylistAttribute()
	{
		return strlen($this->youtube) > 11;
	}

	/**
	 * Get the partial for the Youtube embed for the Talk
	 *
	 * @return string
	 */
	public function getYoutubeEmbedAttribute()
	{
		return View::make('partials.talk-youtube', array(
			'talk' => $this
		));
	}

	/**
	 * Placeholder method to set the view count later on
	 *
	 * @param string $youtube
	 */
	public function setYoutubeAttribute($youtube)
	{
		$this->attributes['youtube'] = $youtube;

		// Set view count
		if ($youtube and strlen($youtube) <= 11) {
			$url = "https://gdata.youtube.com/feeds/api/videos/{$youtube}?v=2&alt=json";

			$this->attributes['youtube_views'] = Cache::remember($url, 3600, function() use ($url) {
				$api = File::getRemote($url);
				$api = json_decode($api);

				return (int) $api->entry->{'yt$statistics'}->viewCount;
			});
		}
	}

	public function getInterestingLinksAttribute()
	{
		$links = $this->links;
		$links = explode(PHP_EOL, $links);
		foreach ($links as &$link) {
			$link = explode(';', $link);
			$link = (object) array(
				'title' => array_get($link, 0),
				'url'   => array_get($link, 1),
			);
		}

		return $links;
	}

	////////////////////////////////////////////////////////////////////
	///////////////////////////// REPOSITORY ///////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Get Talks by latest
	 *
	 * @param  Query $query
	 *
	 * @return Query
	 */
	public function scopeLatest($query)
	{
		return $query->orderBy('from', 'DESC');
	}

	/**
	 * Get all Talks from a Year
	 *
	 * @param  Query   $query
	 * @param  integer $year
	 *
	 * @return Query
	 */
	public function scopeWhereYear($query, $year)
	{
		return $query->where('from', 'LIKE', $year.'-%');
	}

	/**
	 * Get all Talks from a day
	 *
	 * @param  Query   $query
	 * @param  integer $day
	 *
	 * @return Query
	 */
	public function scopeWhereDay($query, $day)
	{
		return $query->where('from', 'LIKE', '%-'.$day.' %');
	}

}
