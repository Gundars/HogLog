
```bash


    ,--.   ,--.     ____  ____   ___      ______  _____       ___      ______
    \  /-~-\  /    |_   ||   _|.'   `.  .' ___  ||_   _|    .'   `.  .' ___  |
     )' a a `(       | |__| | /  .-.  \/ .'   \_|  | |     /  .-.  \/ .'   \_|
    (  ,---.  )      |  __  | | |   | || |   ____  | |   _ | |   | || |   ____
     `(_o_o_)'      _| |  | |_\  `-'  /\ `.___]  |_| |__/ |\  `-'  /\ `.___]  |
       )`-'(       |____||____|`.___.'  `._____.'|________| `.___.'  `._____.'



```
HogLog is log file viewer API for your remote Laravel/Lumen installation

###Installation

Add a dependency to your composer, execute
```php
composer require gundars/hoglog ~0.3.*
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

Hitting the URL of the file it is included in with `browse` parameter will either print the file contents, or list of items in case of a directory.

####Samples:

#####Allow reading all files in logs directory
Code: 
```php
\HogLog\PlanB::getInstance()->view('../storage/logs/');
```
URLs:  
```php
#reads dir
example.com/file-calling-planb.php/?browse=../storage/logs/
#reads file
example.com/file-calling-planb.php/?browse=../storage/logs/lumen.log
```

#####Allow reading all files in storage directory with .txt extension
Code: 
```php
\HogLog\PlanB::getInstance()->view('../storage/', ['.txt']);
```
URL:  
```php
example.com/file-calling-planb.php/?browse=../storage/file.txt
```

#####Allow reading only single file lumen.log
Code: 
```php
\HogLog\PlanB::getInstance()->view('../storage/logs/', ['lumen.log']);
```
URL:  
```php
example.com/file-calling-planb.php/?browse=../storage/file.txt
```
