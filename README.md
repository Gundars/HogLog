
```bash


    ,--.   ,--.     ____  ____   ___      ______  _____       ___      ______
    \  /-~-\  /    |_   ||   _|.'   `.  .' ___  ||_   _|    .'   `.  .' ___  |
     )' a a `(       | |__| | /  .-.  \/ .'   \_|  | |     /  .-.  \/ .'   \_|
    (  ,---.  )      |  __  | | |   | || |   ____  | |   _ | |   | || |   ____
     `(_o_o_)'      _| |  | |_\  `-'  /\ `.___]  |_| |__/ |\  `-'  /\ `.___]  |
       )`-'(       |____||____|`.___.'  `._____.'|________| `.___.'  `._____.'



```

####Installation

Add a dependency to your composer.json:
```php
"gundars/hoglog": "dev-master"
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