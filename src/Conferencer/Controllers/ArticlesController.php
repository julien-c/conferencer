<?php
namespace Conferencer\Controllers;

use BaseController;
use Conferencer\Conferencer;
use Conferencer\Models\Article;
use Conferencer\Models\Article\Repository as ArticleRepository;
use View;

class ArticlesController extends BaseController
{

	/**
	 * Display all articles
	 */
	public function getIndex()
	{
		$articles = Article::orderBy('created_at', 'desc')->get();
		$calendar = ArticleRepository::getCalendar();

		return Conferencer::viewMake('articles.articles')
			->with('calendar', $calendar)
			->with('articles', $articles);
	}

	/**
	 * Display the articles of a certain date
	 *
	 * @param  string $date         The date in the Y-m-d format
	 */
	public function getArchives($date)
	{
		$articles = Article::where('created_at', 'LIKE', $date.'%')->get();

		return Conferencer::viewMake('articles.articles')
			->with('thisDate', $date)
			->with('articles', $articles);
	}

	/**
	 * Display an Article
	 *
	 * @param string $articleSlug
	 */
	public function getArticle($articleSlug)
	{
		$articles = Article::orderBy('created_at', 'asc')->get();
		$article  = Article::slugOrFail($articleSlug);

		return Conferencer::viewMake('articles.article')
			->with('articles', $articles)
			->with('article', $article);
	}

}
