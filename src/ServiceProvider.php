<?php

namespace Dartui\Ewus;

use Illuminate\Support\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider {
	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot() {
		$this->publishes( [
			__DIR__ . '/../config/ewus.php' => config_path( 'ewus.php' ),
		] );
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->app->singleton( 'ewus', function ( $app ) {
			$config = $app->make( 'config' )->get( 'ewus' );

			return new Classes\Manager( $config );
		} );
	}
}
