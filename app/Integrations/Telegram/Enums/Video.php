<?php

namespace App\Integrations\Telegram\Enums;

class Video
{
    public int $id;
    public int $unique_id;
    public int $width;
    public int $height;
    public int $duration;
    public int $thumbnail;
    public string $file_name;
    public int $file_size;

    public function __construct(int $id, int $unique_id, int $width, int $height, int $duration, int $thumbnail, string $file_name, int $file_size)
    {
        $this->id = $id;
        $this->unique_id = $unique_id;
        $this->width = $width;
        $this->height = $height;
        $this->duration = $duration;
        $this->thumbnail = $thumbnail;
        $this->file_name = $file_name;
        $this->file_size = $file_size;
    }
}