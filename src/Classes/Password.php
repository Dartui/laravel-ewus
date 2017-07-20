<?php

namespace Dartui\Ewus\Classes;

use Illuminate\Support\Facades\File;

class Password {
	public static function get() {
		return File::get( static::file() );
	}

	public static function update( $password ) {
		$bytes = File::put( static::file(), $password );

		return false !== $bytes;
	}

	private static function file() {
		return base_path( '.ewus' );
	}
}