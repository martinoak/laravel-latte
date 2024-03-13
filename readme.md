Laravel Latte
=============

Nahrazuje výchozí šablonovací systém [Blade](https://laravel.com/docs/8.x/blade) za české [Latte](https://latte.nette.org)

Prerekvizity
------------
- [Laravel](https://laravel.com/docs/9.x/installation) verze 11.0
- [PHP](https://www.php.net/downloads) alespoň ve verzi 8.2

Instalace
---------
```
$ composer require martinoak/laravel-latte
```

Použití
-------
Do souboru `config/app.php`:
```php

    'providers' => [

        /*
         * Package Service Providers...
         */
        MartinOak\LaravelLatte\ServiceProvider::class

    ],

```

Následně bude možné používat soubory s příponami:
- [*.blade.php](https://laravel.com/docs/8.x/blade)
- [*.latte](https://latte.nette.org)

Výhody
------
- [Latte](https://latte.nette.org) je český šablonovací systém, který je výrazně rychlejší než [Blade](https://laravel.com/docs/8.x/blade)
- [Latte](https://latte.nette.org) nabízí mnohem více možností než [Blade](https://laravel.com/docs/8.x/blade)

Licence
-------
[MIT](https://opensource.org/licenses/MIT)
