<?php


namespace App\Integration\Telegram\Enums;


class Chat
{
    public int $id;
    public string $first_name;
    public ?string $username;
    public string $type;

    public function __construct(int $id, string $first_name, ?string $username, string $type)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->username = $username;
        $this->type = $type;
    }
}