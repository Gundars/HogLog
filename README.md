
```bash


    ,--.   ,--.     ____  ____   ___      ______  _____       ___      ______
    \  /-~-\  /    |_   ||   _|.'   `.  .' ___  ||_   _|    .'   `.  .' ___  |
     )' a a `(       | |__| | /  .-.  \/ .'   \_|  | |     /  .-.  \/ .'   \_|
    (  ,---.  )      |  __  | | |   | || |   ____  | |   _ | |   | || |   ____
     `(_o_o_)'      _| |  | |_\  `-'  /\ `.___]  |_| |__/ |\  `-'  /\ `.___]  |
       )`-'(       |____||____|`.___.'  `._____.'|________| `.___.'  `._____.'



```

####Installation

Add a dependency to your composer, execute
```php
composer require gundars/hoglog 0.1
```


Add the following lines to your /bootstrap/app.php:
```php
config(
    [
        'hoglog' => [
            'rootPrefix' => 'configuration/hoglog/',
            'logdir'     => storage_path() . '/logs'
        ]
    ]
);
$app->register('HogLog\HogLogServiceProvider');
```

If your installation is not booting, but you need laravel-less log reader, use the class found in /extra/PlanB.php
Format: ` 'class::getInstance()->view(string $jailDir[, array $whitelistFilenames])
Sample: `\HogLog\PlanB::getInstance()->view('../', ['.log', '.txt']);`
