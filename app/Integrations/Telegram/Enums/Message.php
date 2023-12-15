<?php

namespace App\Integrations\Telegram\Enums;

use App\Core\Logger\LoggerInterface;
use App\Integrations\Telegram\Enums\Types\UpdateType;
use App\Integrations\Telegram\TelegramClient;

class Message
{
    public int $id;
    public ?string $text;
    public Chat $chat;
    public ?Photo $photo;
    public ?Video $video;
    public ?array $new_chat_members;

    public function __construct(Update $update)
    {
        $data = $update->getType() == UpdateType::MESSAGE ? $update->getData()->message : $update->getData()->callback_query->message;
        $this->id = $data->message_id;
        $this->text = $data->text ?? null;
        $this->chat = new Chat($data->chat->id, $data->chat->first_name ?? $data->chat->title, $data->chat->username ?? null, $data->chat->type);
        $this->video = isset($data->video) ?
            new Video(
                $data->video->file_id,
                $data->video->unique_id,
                $data->video->width,
                $data->video->height,
                $data->video->duration,
                $data->video->thumbnail,
                $data->video->file_name,
                $data->video->file_size
            ) : null;
        $this->photo = isset($data->photo) ?
            new Photo() : null;
        $this->new_chat_members = $data->new_chat_members ?? null;
    }

    public function reply(string $text, $menu = null, $parse = "Markdown", bool $disable_preview = false, $reply_to_message = null): ?array
    {
        if ($menu != null)
            $keyboard["inline_keyboard"] = $menu;
        else
            $keyboard = null;
        return TelegramClient::sendMessage($this->chat->id, $text, $parse, null, $disable_preview, null, null, $reply_to_message, null, $keyboard);
    }


    public function reply_photo(string $photo, string $caption = "", $menu = null, $parse = "Markdown", bool $disable_preview = false, $reply_to_message = null): ?array
    {
        return TelegramClient::sendPhoto($this->chat->id, $photo, $caption, $menu, $parse, null, null, null, $reply_to_message, null);
    }

    public function edit_media(string $media, string $caption = "", $menu = null, string $type_media = 'photo', $parse = "Markdown", bool $disable_preview = false, $reply_to_message = null): ?array
    {
        if ($menu != null)
            $keyboard["inline_keyboard"] = $menu;
        else
            $keyboard = null;
        return TelegramClient::editMessageMedia($this->chat->id, $this->id, null, ["type" => $type_media, "media" => $media, "caption" => $caption, "parse_mode" => $parse], $keyboard);
    }


    public function edit(string $text, array $menu = null, string $parse = "Markdown", bool $disable_preview = null): ?array
    {
        if ($menu != null)
            $keyboard["inline_keyboard"] = $menu;
        else
            $keyboard = null;
        return TelegramClient::editMessageText($this->chat->id, $this->id, null, $text, $parse, null, $disable_preview, $keyboard);
    }

    public function delete(): ?array
    {
        return TelegramClient::deleteMessage($this->chat->id, $this->id);
    }

    public function copy($chat_id): ?array
    {
        return TelegramClient::copyMessage($chat_id, $this->chat->id, $this->id);
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
