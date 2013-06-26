# Installation

Conferencer can be installed either manually, or via Package Installer :

### Via Package Installer

```
php artisan package:install anahkiasen/conferencer
php artisan config:publish anahkiasen/conferencer
php artisan asset:publish anahkiasen/conferencer
php artisan migrate --package anahkiasen/conferencer
```

### Manually

Add Conferencer to the `composer.json` file and run `composer install` :

```json
"anahkiasen/conferencer": "dev-master"
```

Then you'll need to hook Conferencer into Laravel by editing the `app/config/app.php` file.

As Conferencer uses a few other packages underneath you'll need to hook them too :

```php
<?php return array(
	// ...
	'provides' => array(
		// ...
		'Basset\BassetServiceProvider',
		'Former\FormerServiceProvider',
		'Illuminage\IlluminageServiceProvider',
		'Conferencer\ConferencerServiceProvider',
	),

	'aliases' => array(
		// ...
		'Basset' => 'Basset\Facade',
		'Former' => 'Former\Facades\Illuminate',
	),
);
?>
```

Then you'll need to run these few commands to get started :

```
php artisan config:publish anahkiasen/conferencer
php artisan asset:publish anahkiasen/conferencer
php artisan migrate --package anahkiasen/conferencer
```