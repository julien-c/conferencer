<?php
namespace Conferencer\Controllers;

use App;
use BaseController;
use Cache;
use Conferencer\Models\Tag;
use Conferencer\Models\Talk\Repository as TalkRepository;
use Conferencer\Models\Talk\Services as TalkServices;
use Config;
use File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Request;
use Talk;
use View;

class TalksController extends BaseController
{

	/**
	 * See all Talks
	 */
	public function getIndex($filter = null)
	{
		$talks = TalkServices::getFiltered($filter);

		// AJAX displaying
		if (Request::ajax()) {
			$response = null;
			foreach ($talks as $key => $talk) {
				if ($key == 0) $response .= '<article class="item active">';
				elseif ($key % 8 == 0) $response .= '</article><article class="item">';
				$response .= View::make('partials.grid-talk', compact('talk'));
			}

			return $response.'</article>';
		}

		return View::make('results')
			->with('talks', $talks);
	}

	/**
	 * Display the talks program
	 */
	public function getProgram($year = null, $day = null)
	{
		// Get the available days
		$years   = range(2009, 2013);
		$year    = TalkRepository::sanitizeYear($year);

		// Get the available days
		$days    = TalkRepository::getDays($year);
		$day     = TalkRepository::sanitizeDay($year, $day);

		// Get Talks and Tags
		$program = TalkRepository::getProgram($year);

		// Get month
		$lastDay = array_keys($program);
		$lastDay = end($lastDay);
		$month   = $lastDay ? $program[$lastDay][0]->from->format('m') : 0;

		$view = View::exists('talks.program-'.$year)
			? 'talks.program-'.$year
			: 'conferencer::talks.program';

		return View::make($view, array(
			'years'   => $years,
			'year'    => $year,
			'month'   => $month,
			'days'    => $days,
			'day'     => $day,
			'program' => $program,
		));
	}

	/**
	 * Get the program as a PDF
	 */
	public function getProgramPdf($year = null)
	{
		$cacheTime = 60 * 24 * 30; // A month
		$year      = TalkRepository::sanitizeYear($year);

		$output = App::make('path.public').'/app/pdf/'.Config::get('conferencer::pdfs').'-' .$year. '.pdf';

		Cache::remember('program-'.$year, $cacheTime, function() use($year, $output) {

			// Create TCPDF instance
			File::delete($output);
			$tcpdf = new HTML2PDF;

			// Create view
			$talks   = Talk::whereYear($year)->orderBy('from', 'ASC')->get();
			$program = View::make('conferencer::talks.program-pdf')
				->with('talks', $talks)
				->with('year', $year);

			// Generate PDF
			$tcpdf->writeHTML($program->render());
			$tcpdf->output($output, 'F');

			return $output;
		});

		return Response::download($output);
	}

	/**
	 * Display a talk
	 *
	 * @param string $talkSlug The Talk slug
	 */
	public function getTalk($talkSlug)
	{
		$talk   = Talk::slugOrFail($talkSlug);
		$flickr = Config::get('conferencer::accounts.flickr');

		return View::make('conferencer::talks.talk')
			->with('flickr', $flickr)
			->with('talk', $talk);
	}

	/**
	 * Display all the talks for a tag
	 *
	 * @param  string $tag
	 */
	public function getTag($tag)
	{
		$tag = Tag::with('talks', 'talks.speakers')->whereName($tag)->first();
		if (!$tag) throw new ModelNotFoundException('The tag does not exist');

		$talks    = $tag->talks;
		$speakers = $tag->speakers();

		return View::make('results')
			->with('talks', $talks)
			->with('speakers', $speakers)
			->with('tag', $tag);
	}

}
