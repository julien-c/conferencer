<?php
namespace Conferencer;

class Conferencer
{

	/**
	 * A cache of which views are overwritten or not
	 *
	 * @var array
	 */
	protected $overwittenViews;

	/**
	 * Returns a Conferencer view, or the User's if overwritten
	 *
	 * @param  string  $view
	 * @param  array   $data
	 * @param  array   $mergeData
	 *
	 * @return \Illuminate\View\View
	 */
	public function viewMake($view, $data = array(), $mergeData = array())
	{
		if (!array_key_exists($view, $this->overwittenViews)) {
			$this->overwittenViews[$view] = View::exists($view) ? $view : 'conferencer::'.$view;
		}

		return View::make($this->overwittenViews[$view], $data, $mergeData);
	}

}