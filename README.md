# Conferencer

## How to setup

```php
'providers' => array(
	'Conferencer\ConferencerServiceProvider',
),
```

```
composer require anahkiasen/conferencer:dev-master
artisan config:publish anahkiasen/conferencer
artisan asset:publish anahkiasen/conferencer
```

## Expectations

- A global `layouts/layout` with **title** and **layout** hooks for the Conferencer layouts to extend