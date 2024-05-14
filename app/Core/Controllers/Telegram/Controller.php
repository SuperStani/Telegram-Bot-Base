<?php

namespace App\Core\Controllers\Telegram;

use App\Core\Logger\LoggerInterface;

abstract class Controller
{
    protected UserController $user;
    protected LoggerInterface $logger;

    public function __construct(
        UserController  $user,
        LoggerInterface $logger
    )
    {
        $this->user = $user;
        $this->logger = $logger;
    }

    public function process($method, array $params)
    {
        $this->user->save();
        return $this->{$method}(...array_values($params));
    }
}