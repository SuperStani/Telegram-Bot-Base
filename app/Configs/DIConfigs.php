<?php

use App\Configs\DatabaseCredentials;
use App\Configs\RedisConfigurations;
use App\Core\Controllers\Cache\RedisController;
use App\Core\Logger\Logger;
use App\Core\Logger\LoggerInterface;
use App\Core\ORM\DB;
use App\Core\Services\Telegram\UpdateService;
use App\Integrations\Telegram\Enums\Update;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use function DI\factory;


$conf = [
    LoggerInterface::class => factory(function (ContainerInterface $c) {
        return new Logger();
    }),
    DB::class => factory(function (ContainerInterface $c) {
        return new DB(
            $c->get(LoggerInterface::class),
            DatabaseCredentials::HOST,
            DatabaseCredentials::PORT,
            DatabaseCredentials::USER,
            DatabaseCredentials::PASSWORD,
            DatabaseCredentials::DATABASE
        );
    }),
    RedisController::class => factory(function () {
        return new RedisController(
            RedisConfigurations::HOST,
            RedisConfigurations::PORT,
            RedisConfigurations::SOCKET
        );
    }),
    Update::class => factory(function () {
        return UpdateService::get();
    })
];

$builder = new ContainerBuilder();
$builder->addDefinitions($conf);
return $builder->build();
