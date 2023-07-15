<?php

namespace App\Core\Controllers\Telegram;

use App\Core\Logger\LoggerInterface;
use App\Integrations\Telegram\Message;

abstract class MessageController extends Controller
{
    protected Message $message;

    protected LoggerInterface $logger;

    public function __construct(
        Message $message,
        UserController $user,
        LoggerInterface $logger
    )
    {
        $this->message = $message;
        $this->user = $user;
        $this->logger = $logger;
    }
}
