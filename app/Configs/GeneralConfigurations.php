<?php


namespace App\Configs;


use App\Core\Enums\LanguageCode;

interface GeneralConfigurations
{
    public const LOGGER_PATH = "/var/log/ChannelsHelper/";

    public const BOT_TOKEN = "6383950757:AAGTZUD1q14WgES51xKyC2EPYhIrsQAFYpk";

    public const ADMINS = [

    ];

    public const DEFAULT_LANG = LanguageCode::IT;
}