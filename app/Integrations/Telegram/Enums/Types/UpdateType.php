<?php

namespace App\Integrations\Telegram\Enums\Types;

interface UpdateType
{
    public const MESSAGE = 'message';
    public const CALLBACK_QUERY = 'callback_query';
}