<?php
header('Access-Control-Allow-Origin: *');
ini_set('display_errors', true);
error_reporting(E_ALL);
require_once __DIR__ . "/../../../vendor/autoload.php";
require __DIR__ . "/../../Langs/getlang.php";


$container = require_once __DIR__ . "./../../Configs/DIConfigs.php";

$app = new App\Core\Services\Telegram\WebHookService($container);
try {
    $app->handleRequest();
} catch (\Psr\Container\NotFoundExceptionInterface | \Psr\Container\ContainerExceptionInterface | \Exception $e) {
    echo $e->getMessage();
}