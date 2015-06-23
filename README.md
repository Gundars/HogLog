
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
###Plan B
If your installation is not booting, but you need laravel-less log reader, use the /extra/PlanB class

Format:
```class::getInstance()->view(string $jailDir[, array $whitelistFilenames])```

Sample:
```\HogLog\PlanB::getInstance()->view('../', ['.log', '.txt']);```

Hitting the URL of the file it is included in with `browse` parameter will either print the file contents, or list of items in case of a directory.

`example.com/file/including/planb.php/?browse=../`

`example.com/file/including/planb.php/?browse=../app/storage/logs/`
