<?php

namespace App\Integrations\Telegram;

class Message
{
    public ?string $text;
    public ?int $id;
    public ?string $chat_type;
    public ?int $chat_id;
    public mixed $photo;
    public mixed $video;
    public ?array $keyboard;

    public function __construct(Update $update)
    {
        $message = $update->getUpdate();
        if ($update->getType() == 'callback_query')
            $message = $message->message;
        $this->text = $message->text ?? null;
        $this->id = $message->message_id;
        $this->chat_id = $message->chat->id;
        $this->chat_type = $message->chat->type;
        $this->photo = $message->photo ?? null;
        $this->video = $message->video ?? null;
        $this->keyboard = $message->reply_markup->inline_keyboard ?? null;

        $message = null;
    }

    public function reply(string $text, $menu = null, $parse = "Markdown", bool $disable_preview = false, $reply_to_message = null): ?array
    {
        if ($menu != null)
            $keyboard["inline_keyboard"] = $menu;
        else
            $keyboard = null;
        return TelegramClient::sendMessage($this->chat_id, $text, $parse, null, $disable_preview, null, null, $reply_to_message, null, $keyboard);
    }


    public function reply_photo(string $photo, string $caption = "", $menu = null, $parse = "Markdown", bool $disable_preview = false, $reply_to_message = null): ?array
    {
        return TelegramClient::sendPhoto($this->chat_id, $photo, $caption, $menu, $parse, null, null, null, $reply_to_message, null);
    }

    public function edit_media(string $media, string $caption = "", $menu = null, string $type_media = 'photo', $parse = "Markdown", bool $disable_preview = false, $reply_to_message = null): ?array
    {
        if ($menu != null)
            $keyboard["inline_keyboard"] = $menu;
        else
            $keyboard = null;
        return TelegramClient::editMessageMedia($this->chat_id, $this->id, null, ["type" => $type_media, "media" => $media, "caption" => $caption, "parse_mode" => $parse], $keyboard);
    }


    public function edit(string $text, array $menu = null, string $parse = "Markdown", bool $disable_preview = null): ?array
    {
        if ($menu != null)
            $keyboard["inline_keyboard"] = $menu;
        else
            $keyboard = null;
        return TelegramClient::editMessageText($this->chat_id, $this->id, null, $text, $parse, null, $disable_preview, $keyboard);
    }

    public function delete(): ?array
    {
        return TelegramClient::deleteMessage($this->chat_id, $this->id);
    }

    public function copy($chat_id): ?array
    {
        return TelegramClient::copyMessage($chat_id, $this->chat_id, $this->id);
    }

    public function find(string $text): bool
    {
        if (stristr($this->text, $text))
            return true;
        else
            return false;
    }

    public function split($char, $times = null): array|bool
    {
        if (isset($this->text)) {
            return explode($char, $this->text, $times);
        } else
            return false;
    }

    public function command(string $command = ""): bool
    {
        if (str_starts_with($this->text, "/" . $command))
            return true;
        else
            return false;
    }
}
