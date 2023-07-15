<?php

namespace App\Core\Routing;

use App\Core\Controllers\Telegram\Messages\CommandController;
use App\Core\Logger\LoggerInterface;
use App\Integrations\Telegram\Update;
use App\Core\Controllers\Telegram\UserController;
use function DI\factory;

class Route
{

    public static function processUpdate(Update $update)
    {
        $container = require __DIR__ . "/../../Configs/DIConfigs.php";
        $container->set(Update::class, factory(function () {
            global $update;
            return $update;
        }));
        if ($update->getType() == 'message') {
            self::getMessage($container, $update);
        } elseif ($update->getType() == 'callback_query') {
            self::getCallbackData($container, $update);
        }
    }

    private static function getCallbackData($container, Update $update): void
    {
        $e = explode(":", $update->getUpdate()->data);
        $controller = $e[0] . 'Controller';
        $controller = "App\\Core\\Controllers\\Telegram\\Query\\" . $controller;
        if (class_exists($controller)) {
            $params = explode("|", $e[1]);
            $method = $params[0];
            unset($params[0]);
            $controller = $container->get($controller);
            $controller->callAction($method, $params);
        } else {
            $log = $container->get(LoggerInterface::class);
            $log->warning($controller);
        }
    }

    private static function getMessage($container, Update $update): void
    {
        if (isset($update->getUpdate()->entities) and $update->getUpdate()->entities[0]->type == "bot_command") {
            $controller = $container->get(CommandController::class);
            $controller->callAction('check', []);
        } else {
            $user = $container->get(UserController::class);
            $e = explode(":", $user->getPage());
            if (isset($e[1])) { //Se ci sono parametri nel page
                $section = $e[0]; //la sezione
                $params = explode("|", $e[1]); //Parametri
                $method = $params[0];
                unset($params[0]); //Aggiusto i parametri
                $controller = "App\\Core\\Controllers\\Telegram\\Messages\\" . $section . "Controller";
                if (class_exists($controller)) {
                    $container->injectOn($user);
                    $controller = $container->get($controller);
                    $controller->callAction($method, $params);
                    return;
                }
            }
        }
    }
}
