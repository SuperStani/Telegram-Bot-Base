<?php


namespace App\Configs;


use App\Core\Enums\LanguageCode;

interface GeneralConfigurations
{
    public const LOGGER_PATH = "/var/log/ChannelsHelper/";

    public const BOT_TOKEN = "";

    public const ADMINS = [

    ];

    public const DEFAULT_LANG = LanguageCode::IT;
}