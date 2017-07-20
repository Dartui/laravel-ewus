# Laravel eWUŚ
eWUŚ integration for Laravel

## Usage

```php
use Dartui\Ewus\Exceptions\ResponseException;
use Dartui\Ewus\Facade as Ewus;

class Foo {
	public function pesel() {
		try {
			$pesel = Ewus::checkPesel( '00000000000' );
			
			if ( $pesel->hasInsurance() ) {
				$first_name   = $pesel->getFirstName();
				$last_name    = $pesel->getLastName();
				$operation_id = $pesel->getOperationID();
			}
		} catch ( ResponseException $e ) {
			// you can use $e->getMessage() here
		}
	}

	// new password will be automatically stored in .ewus file
	public function password() {
		$new_password = 'secret';

		if ( Ewus::changePassword( $new_password ) ) {
			echo 'Success!';
		} else {
			echo 'Error';
		}
	}
}
```

## Instalation

Require this package with composer:

```shell
composer require dartui/ewus
```

After updating composer, add the ServiceProvider to the providers array in `config/app.php`

> Laravel 5.5 uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider

```php
Dartui\Ewus\ServiceProvider::class
```

Copy the package config to your local config with the publish command:

```shell
php artisan vendor:publish --provider=Dartui\\Ewus\\ServiceProvider
```

Add values to your `.env` file, for example:
```
EWUS_LOGIN=mylogin
EWUS_TYPE=SWD
EWUS_DOMAIN=11
EWUS_CODE=123456
```

And create `.ewus` file in root of your project in which will be stored password.