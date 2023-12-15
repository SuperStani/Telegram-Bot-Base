<?php


namespace App\Integrations\Telegram\Enums;


class Chat
{
    public int $id;
    public string $name;
    public ?string $username;
    public string $type;

    public function __construct(int $id, string $name, ?string $username, string $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->type = $type;
    }
}