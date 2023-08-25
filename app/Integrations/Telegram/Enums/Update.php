<?php

namespace App\Integrations\Telegram\Enums;

use App\Integrations\Telegram\Enums\Types\UpdateType;

class Update
{
    private mixed $data;
    private string $type;

    public function __construct(mixed $update)
    {
        $this->data = $update;
        $this->type = isset($this->data->callback_query) ? UpdateType::CALLBACK_QUERY : UpdateType::MESSAGE;
    }

    public function getData(): mixed
    {
        return $this->data;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
