<?php

namespace App\Core\Controllers\Telegram;

use App\Core\Logger\LoggerInterface;
use App\Integrations\Telegram\Message;

abstract class MessageController extends Controller
{
    protected Message $message;

    public function __construct(
        Message $message,
        UserController $user,
        LoggerInterface $logger
    )
    {
        parent::__construct($user, $logger);
        $this->message = $message;
    }
}
