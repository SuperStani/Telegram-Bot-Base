<?php


namespace App\Integrations\Telegram\Enums\Types;


interface ChatType
{
    public const PRIVATE = 'private';
    public const CHANNEL = 'channel';
    public const GROUP = 'group';
    public const SUPERGROUP = 'supergroup';
}