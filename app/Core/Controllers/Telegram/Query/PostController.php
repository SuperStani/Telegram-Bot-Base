<?php

namespace App\Core\Controllers\Telegram\Query;


use App\Core\Controllers\Telegram\QueryController;

class PostController extends QueryController
{
    public function new()
    {
        $this->user->page("Post:poster");
        $menu[] = [["text" => get_button('it', 'back'), "callback_data" => "Home:start"]];
        $this->query->message->delete();
        $this->query->message->reply("Ok, inviami il poster:", $menu);
    }

}
