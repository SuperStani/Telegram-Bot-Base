<?php


namespace App\Core\Services\Telegram;


use App\Core\Controllers\Telegram\UserController;
use App\Core\Logger\LoggerInterface;
use App\Integrations\Telegram\Enums\Message;
use App\Integrations\Telegram\Enums\Query;
use App\Integrations\Telegram\Enums\Types\UpdateType;
use App\Integrations\Telegram\Enums\Update;
use App\Integrations\Telegram\TelegramClient;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class WebHookService
{
    private ContainerInterface $container;

    private LoggerInterface $logger;
    private const CONTROLLERS_CLASS_NAME_DEFAULT = "App\\Core\\Controllers\\Telegram";

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->logger = $this->container->get(LoggerInterface::class);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handleRequest(): void
    {
        $update = $this->container->get(Update::class);
        if ($update->getType() == UpdateType::CALLBACK_QUERY) {
            $query = $this->container->get(Query::class);
            $this->processCallbackControllerClass($query->data);
        } else if ($update->getType() == UpdateType::MESSAGE) {
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
        if ($message->command()) {
            $data = str_replace(["/", " "], ["", "|"], $message->text);
            $data = "Commands:$data";
        } else {
            $userController = $this->container->get(UserController::class);
            $data = $userController->getPage();
        }
        $this->processController($data, 'Messages');
    }

    private function processController(string $data, string $type): void
    {
        $e = explode(":", $data);
        $controllerClass = self::CONTROLLERS_CLASS_NAME_DEFAULT . "\\" . $type . "\\" . $e[0] . "Controller";
        if (class_exists($controllerClass)) {
            $e = explode("|", $e[1]);
            $method = $e[0];
            unset($e[0]);
            try {
                $app = $this->container->get($controllerClass);
                if (method_exists($app, $method)) {
                    $app->process($method, $e);
                }
            } catch (\Exception|NotFoundExceptionInterface|ContainerExceptionInterface $e) {
                $this->logger->error($data, $e->getMessage());
            }
        } else {
            $this->logger->error("$controllerClass doesn't exists", $data);
        }
    }
}