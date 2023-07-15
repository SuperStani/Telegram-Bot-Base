<?php

namespace App\Integrations\Telegram;

class Query
{
    public Message $message;
    public ?int $id;
    public ?string $data;

    public function __construct(Update $update, Message $message)
    {
        $update = $update->getUpdate();
        $this->data = $update->data ?? null;
        $this->id = $update->id ?? null;
        $this->message = $message;
        $update = null;
    }

    public function alert(string $text = "💙", bool $show = false, string $url = null): ?array
    {
        return TelegramClient::answerCallbackQuery($this->id, $text, $show, $url);
    }

    public function editButton(array $menu): ?array
    {
        $keyboard["inline_keyboard"] = $menu;
        return TelegramClient::editMessageReplyMarkup($this->message->chat_id, $this->message->id, null, $keyboard);
    }
}
