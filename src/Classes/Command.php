<?php

namespace Dartui\Ewus\Classes;

use Dartui\Ewus\Facade as Ewus;
use Illuminate\Console\Command as BaseCommand;

class Command extends BaseCommand {
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update eWUS password';

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'ewus:password {password?}';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		$password = $this->argument('password') ?: str_random( 16 );
		
		if (Ewus::changePassword( $password )) {
			$this->info('Pomyślnie zmieniono hasło do systemu eWUŚ.');
		} else {
			$this->error('Błąd podczas zmiany hasła do systemu eWUŚ.');
		}
	}
}
