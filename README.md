# PHP Multi Process Manager
This is a very lightweight but powerful wrapper allowing for background, multi-threaded processing in PHP by making use of `pcntl`.

## Requirements
 - PHP 7.0.0+
 - PHP's `pcnlt` library installed (For installation instruction, please see: http://php.net/manual/en/pcntl.installation.php)
 - Running within on a Unix platform (Redhat, CentOS, Ubuntu, BSD...)
 - Scripts to be ran from CLI (this is a requirement of `pcntl`)

## Basic example
```
<?php
require('multiProcessManager.php');

$feeds = [
    'https://fakeurl.com/feed.xml',
    'https://fakeurl.com/feed.csv',
    // ...
];

$workers = []; // Workers will need to contain callables (see example below)
foreach ($feeds as $feed) {
    $workers[] = function(string $feed_url): bool {
        if ($feed_contents = file_get_contents($feed_url)) {
            // Log to DB, file or output to screen. As this is only a basic example, we won't bother doing so here.
        }
    };
}

// Let the processing begin!
new multiProcessManager('multiProcessManager example', $workers);
```
Please see example.php for more details.

If you have any issues, please submit them here on GitHub, Pull requests are very welcome too!

Enjoy!
