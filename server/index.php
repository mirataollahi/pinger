<?php


require __DIR__ .'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Network monitoring service application (Ping tools)
|--------------------------------------------------------------------------
|
| This software is designed to make it easy to monitoring the network status.
| You can see the connection status (ping time and packet lost) of your server with the addresses of selected networks in a moment and do troubleshooting easily .
| This software is free , designed with PHP language and open source .
| I hope you enjoy this service. Thanks (AM)
|
*/

use Server\Application;
$app = new Application();
$response = $app->run();
echo $response;
