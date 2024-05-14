<?php

namespace App\Integrations\Telegram\Enums;

class Photo
{
    public string $file_id;

    public function __construct(string $file_id)
    {
        $this->file_id = $file_id;
    }
}