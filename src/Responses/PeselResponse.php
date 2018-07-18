<?php

namespace Dartui\Ewus\Responses;

use gilek\ewus\responses\CheckPeselResponse as BasePeselResponse;

class PeselResponse {
	private $error = null;

	private $response = null;

	public function __construct( $response ) {
		if ( $response instanceOf BasePeselResponse ) {
			$this->response = $response;
		} else {
			$this->error = $response;
		}
	}

	public function getDomain() {
		return $this->hasResponse() ? $this->getResponse()->getData( 5 ) : false;
	}

	public function getError() {
		return $this->error;
	}

	public function getFirstName() {
		return $this->hasResponse() ? $this->getResponse()->getData( 3 ) : false;
	}

	public function getLastName() {
		return $this->hasResponse() ? $this->getResponse()->getData( 4 ) : false;
	}

	public function getOperationID() {
		return $this->hasResponse() ? $this->getResponse()->getData( 2 ) : false;
	}

	public function getResponse() {
		return $this->response;
	}

	public function getStatus() {
		return $this->hasResponse() ? $this->getResponse()->getData( 1 ) : false;
	}

	public function hasError() {
		return $this->getError() !== null;
	}

	public function hasInsurance() {
		return $this->getStatus() == 1;
	}

	public function hasResponse() {
		return $this->getResponse() !== null;
	}
}
