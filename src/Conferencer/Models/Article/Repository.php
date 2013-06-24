<?php
namespace Conferencer\Models\Article;

use Conferencer\Models\Article;

class Repository
{

	public static function getCalendar()
	{
		$articles = Article::orderBy('created_at', 'asc')->get();
		$calendar = array();

		foreach ($articles as $article) {
			$year  = $article->created_at->year;
			$month = $article->created_at->format('M');
			$day   = $article->created_at->format('D, dS');

			$calendar[$year][$month][$day] = $article->created_at->toDateString();
		}

		return $calendar;
	}

}
