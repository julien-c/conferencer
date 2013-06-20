<?php
namespace Conferencer;

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

    // Register routes
    include __DIR__.'/../routes.php';
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}