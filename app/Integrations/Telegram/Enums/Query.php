<?php

namespace App\Integrations\Telegram\Enums;

use App\Integrations\Telegram\TelegramClient;

class Query
{
    public Message $message;
    public ?int $id;
    public ?string $data;

    public function __construct(Update $update, Message $message)
    {
        $update = $update->getData();
        $this->data = $update->callback_query->data ?? null;
        $this->id = $update->callback_query->id ?? null;
        $this->message = $message;
    }

    public function alert(string $text = "💙", bool $show = false, string $url = null): ?array
    {
        return TelegramClient::answerCallbackQuery($this->id, $text, $show, $url);
    }

    public function editButton(array $menu): ?array
    {
        $keyboard["inline_keyboard"] = $menu;
        return TelegramClient::editMessageReplyMarkup($this->message->chat->id, $this->message->id, null, $keyboard);
    }
}
