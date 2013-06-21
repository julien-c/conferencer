<?php
namespace Conferencer\Controllers;

use BaseController;
use Conferencer\Models\Speaker;
use Conferencer\Models\Speaker\Services as SpeakerServices;
use Request;
use View;

class SpeakersController extends BaseController
{

	/**
	 * Display all Speakers
	 */
	public function getIndex($filter = null)
	{
		$speakers = SpeakerServices::getFiltered($filter);

		// AJAX displaying
		if (Request::ajax()) {
			$response = null;
			foreach ($speakers as $speaker) {
				$response .= View::make('partials.grid-speaker', compact('speaker'));
			}

			return $response;
		}

		return View::make('conferencer::speakers.speakers')
			->with('speakers', $speakers);
	}

	/**
	 * Display a Speaker
	 *
	 * @param string $speakerSlug The Speaker's slug
	 */
	public function getSpeaker($speakerSlug)
	{
		$speaker = Speaker::slugOrFail($speakerSlug);
		$speaker->load('talks', 'talks.tags');

		return View::make('conferencer::speakers.speaker')
			->with('speaker', $speaker);
	}

}
