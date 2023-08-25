<?php


namespace App\Core\Services\Telegram;


class WebHookService
{
    public static function handleRequest()
    {
        $update = UpdateService::get();
    }
}