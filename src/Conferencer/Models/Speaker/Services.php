<?php
namespace Conferencer\Models\Speaker;

use Conferencer\Models\Speaker;
use Conferencer\Models\Talk;

class Services
{

	/**
	 * Get a filtered set of Speakers
	 *
	 * @param  [string,null] $filter The filter
	 *
	 * @return Collection
	 */
	public static function getFiltered($filter = null)
	{
		switch ($filter) {

			// Sort by latest talks
			case 'latest':
				$speakers = array();
				$talks = Talk::with('speakers')->latest()->get();
				foreach ($talks as $talk) {
					foreach ($talk->speakers as $speaker) {
						if (isset($speakers[$speaker->id])) continue;
						$speakers[$speaker->id] = $speaker;
					}
				}
				break;

			// Sort by name
			case 'alpha':
				$speakers = Speaker::orderBy('name', 'ASC')->get();
				break;

			// No filter
			case null:
			default:
				$speakers = Speaker::all();
				break;
		}

		return $speakers;
	}

}
