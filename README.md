# Conferencer

## How to setup

### Manually

```php
'providers' => array(
	'Conferencer\ConferencerServiceProvider',
),

'aliases' => array(
	'Former' => 'Former\Facades\Illuminate',
),
```

```
composer require anahkiasen/conferencer:dev-master
artisan config:publish anahkiasen/conferencer
artisan asset:publish anahkiasen/conferencer
```

### With Package Installer

```
artisan package:install anahkiasen/conferencer
artisan config:publish anahkiasen/conferencer
artisan asset:publish anahkiasen/conferencer
```

## Expectations
