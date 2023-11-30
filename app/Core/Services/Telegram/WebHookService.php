<?php


namespace App\Core\Services\Telegram;


use App\Core\Controllers\Telegram\UserController;
use App\Core\Logger\LoggerInterface;
use App\Integrations\Telegram\Enums\Message;
use App\Integrations\Telegram\Enums\Types\UpdateType;
use App\Integrations\Telegram\Enums\Update;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class WebHookService
{
    private ContainerInterface $container;
    private const CONTROLLERS_CLASS_NAME_DEFAULT = "App\\Core\\Controllers\\Telegram";

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handleRequest(): void
    {
        $update = $this->container->get(Update::class);
        if ($update->getType() == UpdateType::CALLBACK_QUERY) {
            $this->processCallbackControllerClass($update->getData()->data);
        } else if($update->getType() == UpdateType::MESSAGE) {
            $this->processMessageControllerClass();
        } else {
            die('Unknown request');
        }
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function processCallbackControllerClass(string $data): void
    {
        $this->processController($data, 'Query');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function processMessageControllerClass(): void
    {
        $message = $this->container->get(Message::class);
        if ($message->text->command()) {
            $data = str_replace(["/", " "], ["", "|"], $message->text);
            $data = "Commands:$data";
        } else {
            $userController = $this->container->get(UserController::class);
            $data = $userController->getPage();
        }
        $this->processController($data, 'Message');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function processController(string $data, string $type): void
    {
        $e = explode(":", $data);
        $controllerClass = self::CONTROLLERS_CLASS_NAME_DEFAULT . "\\" . $type . "\\" . $e[0] . "Controller";
        if (class_exists($controllerClass)) {
            $e = explode($e[1], "|");
            $method = $e[0];
            unset($e[0]);
            $app = $this->container->get($controllerClass);
            $app->process($method, $e);
        } else {
            $logger = $this->container->get(LoggerInterface::class);
            $logger->error("$controllerClass doesn't exists", $data);
        }
    }
}