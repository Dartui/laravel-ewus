<?php

namespace Dartui\Ewus\Classes;

class PESEL {
	private $response;

	public function __construct( $response ) {
		$this->response = $response;
	}

	public function getDomain() {
		return $this->response->getData( 5 );
	}

	public function getFirstName() {
		return $this->response->getData( 3 );
	}

	public function getLastName() {
		return $this->response->getData( 4 );
	}

	public function getOperationID() {
		return $this->response->getData( 2 );
	}

	public function getStatus() {
		return $this->response->getData( 1 );
	}
	
	public function hasInsurance() {
		return $this->getStatus() == 1;
	}
}