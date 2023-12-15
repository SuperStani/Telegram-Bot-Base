<?php


namespace App\Integrations\Telegram\Enums;


use App\Configs\GeneralConfigurations;
use App\Integrations\Telegram\Enums\Types\UpdateType;
use App\Integrations\Telegram\Enums\Update;

class User
{
    public int $id;
    public string $first_name;
    public ?string $username;
    public string $language_code;

    public function __construct(Update $update)
    {
        $data = ($update->getType() == UpdateType::MESSAGE) ? $update->getData()->message->from : $update->getData()->callback_query->from;
        $this->id = $data->id;
        $this->first_name = $data->first_name;
        $this->username = $data->username ?? null;
        $this->language_code = $data->language_code ?? GeneralConfigurations::DEFAULT_LANG;
    }

    public function getMention(): string
    {
        return "[" . $this->first_name . "](tg://user?id=" . $this->id . ")";
    }
}