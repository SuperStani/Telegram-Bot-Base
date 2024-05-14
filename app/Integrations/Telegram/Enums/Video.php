<?php

namespace App\Integrations\Telegram\Enums;

class Video
{
    public string $id;
    public ?int $unique_id;
    public ?int $width;
    public ?int $height;
    public ?int $duration;
    public ?string $file_name;
    public ?int $file_size;

    public function __construct(string $id, ?int $unique_id, ?int $width, ?int $height, ?int $duration, ?string $file_name, ?int $file_size)
    {
        $this->id = $id;
        $this->unique_id = $unique_id;
        $this->width = $width;
        $this->height = $height;
        $this->duration = $duration;
        $this->file_name = $file_name;
        $this->file_size = $file_size;
    }
}