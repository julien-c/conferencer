<?php
namespace Conferencer\Controllers;

use Article;
use BaseController;
use View;

class ArticlesController extends BaseController
{

	/**
	 * Display all articles
	 */
	public function getIndex()
	{
		$articles = Article::orderBy('created_at', 'desc')->get();

		return View::make('articles.articles')
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

		return View::make('articles.articles')
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
		$article = Article::slugOrFail($articleSlug);

		return View::make('articles.article')
			->with('articles', $articles)
			->with('article', $article);
	}

}
