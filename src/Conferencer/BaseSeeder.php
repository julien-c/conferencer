<?php
namespace Conferencer;

use Seeder;
use Symfony\Component\DomCrawler\Crawler;

abstract class BaseSeeder extends Seeder
{

	/**
	 * Fetch a page from a website, cache it and return a Crawler of it
	 *
	 * @param  string $url
	 *
	 * @return Crawler
	 */
	protected function fetchRemote($url)
	{
		$page = Cache::sear($url, function() use ($url) {
			print 'Fetching '.$url.PHP_EOL;
			return File::getRemote($url);
		});

		return new Crawler($page);
	}

	/**
	 * Clean up a piece of HTML content
	 *
	 * @param  string  $content
	 * @param  boolean $html Whether the content is HTML or not
	 *
	 * @return string
	 */
	protected function cleanContent($content, $html = true)
	{
		$content = trim($content, " \t\r\n");
		$content = str_replace('div>', 'p>', $content);
		$content = str_replace(' ', ' ', $content);
		$content = str_replace('Â ', null, $content);

		if ($html) {
			$content = str_replace("\n", '', $content);
		}

		return utf8_decode($content);
	}

}
