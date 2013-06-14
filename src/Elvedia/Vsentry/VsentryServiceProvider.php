<?php namespace Elvedia\Vsentry;

use Illuminate\Support\ServiceProvider;

/*
 * This file is part of the Sentry 2 View Helper package (Vsentry)
 *
 *    DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
 *                  Version 2, December 2004
 *
 * Copyright (C) 2014 Elvin Verlaat
 * Everyone is permitted to copy and distribute verbatim or modified
 * copies of this license document, and changing it is allowed as long
 * as the name is changed.
 * 
 *            DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
 *   TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION
 * 
 * 0. You just DO WHAT THE FUCK YOU WANT TO.
 *
 */

class VsentryServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('elvedia/vsentry');

		include ( __DIR__ . '/../../routes.php');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['vsentry'] = $this->app->share( function( $app ) {
			return new Vsentry( );
		});

		$this->app['vsentry-html'] = $this->app->share( function( $app ) {
			return new VsentryHtml( );
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array( 'vsentry', 'vsentry-html' );
	}

}