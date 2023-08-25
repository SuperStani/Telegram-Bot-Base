<?php


namespace App\Core\Services\Telegram;


use App\Core\Controllers\Telegram\UserController;
use App\Core\Logger\LoggerInterface;
use App\Integrations\Telegram\Enums\Types\UpdateType;
use App\Integrations\Telegram\Enums\Update;
use App\Integrations\Telegram\Message;
use Psr\Container\ContainerInterface;

class WebHookService
{
    private ContainerInterface $container;
    private const CONTROLLERS_CLASS_NAME_DEFAULT = "App\\Core\\Controllers\\Telegram";

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function handleRequest()
    {
        $update = $this->container->get(Update::class);
        if ($update->getType() == UpdateType::CALLBACK_QUERY) {
            $this->processCallbackControllerClass($update->getData()->data);
        } else {
            $this->processMessageControllerClass();
        }
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private function processCallbackControllerClass(string $data): void
    {
        $this->processController($data, 'Query');
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private function processMessageControllerClass(): void
    {
        $message = $this->container->get(Message::class);
        if ($message->text->command()) {
            $data = str_replace(" ", "|", $message->text);
            $data = "Commands:$data";
        } else {
            $userController = $this->container->get(UserController::class);
            $data = $userController->getPage();
        }
        $this->processController($data, 'Message');
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private function processController(string $data, string $type)
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