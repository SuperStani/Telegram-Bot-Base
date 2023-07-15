<?php

namespace App\Core\Controllers\Telegram\Messages;

use App\Core\Controllers\Telegram\MessageController;
use App\Core\Controllers\Telegram\UserController;
use App\Integrations\Telegram\Message;


class CommandController extends MessageController
{

    public function __construct(
        Message $message,
        UserController $user
    )
    {
        $this->message = $message;
        $this->user = $user;
    }

    public function start($param = null): ?array
    {
        $this->user->save();
        if (!$param) {
            $this->user->page();
            if ($this->user->isAdmin()) {
                $menu[] = [["text" => "TEST ADMIN", "callback_data" => "Post:new"]];
            }
            $menu[] = [["text" => "TEST USER", "callback_data" => "Post:new"]];
            $text = "Test message";
            return $this->message->reply($text, $menu);
        } else {
            $param = explode("_", $param);
            switch ($param[0]) {
                default:
                   break;
            }
        }
    }


    public function check()
    {
        $e = explode(" ", $this->message->text);
        $method = str_replace("/", "", $e[0]);
        unset($e[0]);
        return $this->callAction($method, $e);
    }
}
