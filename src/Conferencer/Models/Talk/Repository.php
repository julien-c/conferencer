<?php
namespace Conferencer\Models\Talk;

use Cache;
use Config;
use DB;
use Talk;

class Repository
{

	/**
	 * Number of minutes in a month
	 *
	 * @var integer
	 */
	protected static $cacheTime = 43200;

	/**
	 * Get the Talks for the homepage
	 *
	 * @return Query
	 */
	public static function forHomepage()
	{
		$talks = Config::get('conferencer::home_talks');

		return Talk::whereIn('slug', $talks);
	}

	/**
	 * Get the Talks for a specific year
	 *
	 * @param  integer $year
	 *
	 * @return array
	 */
	public static function getProgram($year = null)
	{
		$year = static::sanitizeYear($year);

		$talks = Talk::with('speakers', 'tags')
			->whereYear($year)
			->orderBy('from', 'ASC')->get();

		// Build program
		$program = array();
		foreach ($talks as $talk) {
			$program[$talk->date][] = $talk;
		}

		return $program;
	}

	/**
	 * Get all years where talks have happened
	 *
	 * @return array
	 */
	public static function getYears()
	{
		return Cache::remember('program.years', static::$cacheTime, function() {
			$years = DB::raw('strftime("%Y", `from`) AS year');
			$years = Talk::select($years)->groupBy('year')->lists('year');

			return $years;
		});
	}

	/**
	 * Get all the days here talks have happened
	 *
	 * @return array
	 */
	public static function getDays($year)
	{
		return Cache::remember('program.' .$year. '.days00', static::$cacheTime, function() use ($year) {
			$days = DB::raw('strftime("%d", `from`) AS day');
			$days = Talk::select($days)->whereYear($year)->groupBy('day')->lists('day');

			return $days;
		});
	}

	////////////////////////////////////////////////////////////////////
	/////////////////////////////// HELPERS ////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Sanitize a year or fallback to latest one
	 *
	 * @param  integer $year
	 *
	 * @return integer
	 */
	public static function sanitizeYear($year = null)
	{
		$years = static::getYears();
		if (!$year) $year = end($years);

		return $year;
	}

	/**
	 * Sanitize a day or fallback to latest one
	 *
	 * @param  integer $year
	 * @param  integer $day
	 *
	 * @return integer
	 */
	public static function sanitizeDay($year, $day = null)
	{
		$days = static::getDays($year);
		if (!$day or !in_array($day, $days)) {
			$day = end($days);
		}

		return $day;
	}

}
