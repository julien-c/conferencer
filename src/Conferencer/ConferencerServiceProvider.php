<?php
namespace Conferencer;

use Blade;
use HTML;
use Illuminate\Support\ServiceProvider;

class ConferencerServiceProvider extends ServiceProvider
{

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// Register config file
		$this->app['config']->package('anahkiasen/conferencer', __DIR__.'/../config');

		// Register views
		$this->app['view']->addNamespace('conferencer', __DIR__.'/../../views');

		// Share global variables
		$this->app['view']->share('layoutClassic', $this->getView('layouts.classic'));
		$this->app['view']->share('layoutUnicol',  $this->getView('layouts.unicol'));
		$this->app['view']->share('website', $this->app['config']->get('conferencer::website'));
	}

	/**
	 * Boot Conferencer
	 *
	 * @return void
	 */
	public function boot()
	{
		// Register macros
		$this->registerMacros();

		// Register Routes and View composers
		include __DIR__.'/../assets.php';
		include __DIR__.'/../composers.php';
		include __DIR__.'/../routes.php';

		// Register custom Blade @include
		Blade::extend(function($view, $blade) {
			$pattern = $blade->createMatcher('includeFallback');
			$replace = PHP_EOL.'@if (View::exists$2)'.PHP_EOL.'@include$2'.PHP_EOL.'@else'.PHP_EOL.'@include$2'.PHP_EOL.'@endif';
			$view = preg_replace($pattern, $replace, $view);
			$view = str_replace("@else".PHP_EOL."@include('", "@else".PHP_EOL."@include('conferencer::", $view);

			return $view;
		});
	}

	/**
	 * Register custom HTML macros
	 *
	 * @return void
	 */
	protected function registerMacros()
	{
		HTML::macro('linkBlank', function($url, $value = null) {
			return HTML::link($url, $value, array('target' => '_blank'));
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('conferencer');
	}

	////////////////////////////////////////////////////////////////////
	/////////////////////////////// HELPERS ////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Get an User defined view, or the fallback one
	 *
	 * @param  string $view
	 *
	 * @return string
	 */
	protected function getView($view)
	{
		return $this->app['view']->exists($view) ? $view : 'conferencer::'.$view;
	}

}
