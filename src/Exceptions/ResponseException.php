<?php

namespace Dartui\Ewus\Exceptions;

use Exception;
use gilek\ewus\exceptions\ResponseException as BaseException;

class ResponseException extends BaseException {
	public function __construct( $message, $code = 0, Exception $previous = null ) {
		$message = sprintf( 'eWUŚ: %s', html_entity_decode( $message ) );

		parent::__construct( $message, $code, $previous );
	}
}