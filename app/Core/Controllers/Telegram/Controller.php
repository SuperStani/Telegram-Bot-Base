<?php

namespace App\Core\Controllers\Telegram;


abstract class Controller
{
    protected UserController $user;

    public function callAction($method, array $params)
    {
        //$this->user->update();
        return $this->{$method}(...array_values($params));
    }
}