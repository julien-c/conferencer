<?php
namespace Conferencer;

use View;

class Conferencer
{

	/**
	 * A cache of which views are overwritten or not
	 *
	 * @var array
	 */
	protected static $overwittenViews = array();

	/**
	 * Returns a Conferencer view, or the User's if overwritten
	 *
	 * @param  string  $view
	 * @param  array   $data
	 * @param  array   $mergeData
	 *
	 * @return \Illuminate\View\View
	 */
	public static function viewMake($view, $data = array(), $mergeData = array())
	{
		if (!array_key_exists($view, static::$overwittenViews)) {
			static::$overwittenViews[$view] = View::exists($view) ? $view : 'conferencer::'.$view;
		}

		return View::make(static::$overwittenViews[$view], $data, $mergeData);
	}

}