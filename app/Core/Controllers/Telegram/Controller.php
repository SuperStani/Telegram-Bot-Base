<?php

namespace App\Core\Controllers\Telegram;


abstract class Controller
{
    protected UserController $userController;

    public function process($method, array $params)
    {
        return $this->{$method}(...array_values($params));
    }
}