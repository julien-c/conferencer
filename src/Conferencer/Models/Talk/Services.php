<?php
namespace Conferencer\Models\Talk;

use Talk;

class Services
{

	/**
	 * Get a filtered set of Talks
	 *
	 * @param  [string,null] $filter The filter
	 *
	 * @return Collection
	 */
	public static function getFiltered($filter = null)
	{
		switch ($filter) {

			// Sort by latest Talks
			default:
				$talks = Talk::latest();
				break;
		}

		// Eager load relations
		$talks->with('speakers', 'tags');

		return $talks->get();
	}

}
