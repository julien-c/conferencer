<?php
namespace Conferencer;

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
		$this->app['config']->package('anahkiasen/conferencer', __DIR__.'/../../config');

		// Register views
		$this->app['view']->addNamespace('conferencer', __DIR__.'/../../views');
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

}
