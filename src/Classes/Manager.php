<?php

namespace Dartui\Ewus\Classes;

use Dartui\Ewus\Exceptions\ResponseException;
use gilek\ewus\Client;
use gilek\ewus\drivers\SoapDriver;
use gilek\ewus\exceptions\ResponseException as BaseException;
use Illuminate\Support\Facades\Cache;

class Manager {
	private $client;

	private $code;

	private $domain;

	private $login;

	private $password;

	private $type;

	public function __construct( $config ) {
		$this->client = new Client( new SoapDriver() );

		$this->login  = $config['login'];
		$this->type   = $config['type'];
		$this->domain = $config['domain'];
		$this->code   = $config['code'];
	}

	public function password( $password ) {
		try {
			$this->login();
			$response = $this->client->changePassword( $password );
			$this->logout();
		} catch ( BaseException $e ) {
			throw new ResponseException( $e->getMessage() );
		}

		return Password::update( $password );
	}

	public function pesel( $pesel, $cache = false, $force = false ) {
		if ( $cache && ! $force ) {
			$key      = $this->getCacheKey( $pesel );
			$duration = $cache ?: 6;

			return Cache::remember( $key, $duration, function () use ( $pesel ) {
				return $this->checkPesel( $pesel );
			} );
		}

		return $this->checkPesel( $pesel );
	}

	private function checkPesel( $pesel ) {
		try {
			$this->login();
			$response = $this->client->checkPesel( $pesel );
			$this->logout();
		} catch ( BaseException $e ) {
			throw new ResponseException( $e->getMessage() );
		}

		return new PESEL( $response );
	}

	private function getCacheKey( $pesel ) {
		return 'Dartui\Ewus\pesel_' . $pesel;
	}

	private function login() {
		$params = [
			'type'    => $this->type,
			'domain'  => $this->domain,
			'idntSwd' => $this->code,
		];

		$params = array_filter( $params );

		$this->client->login( $this->login, Password::get(), $params );
	}

	private function logout() {
		$this->client->logout();
	}
}