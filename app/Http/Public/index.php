<?php
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . "/../../../vendor/autoload.php";
require __DIR__ . "/../../Langs/getlang.php";


try {
    $container = require_once __DIR__ . "/../../Configs/DIConfigs.php";
    $app = new App\Core\Services\Telegram\WebHookService($container);
    $app->handleRequest();
} catch (\Psr\Container\NotFoundExceptionInterface | \Psr\Container\ContainerExceptionInterface | \Exception $e) {
    echo $e->getMessage();
}