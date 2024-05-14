<?php

namespace App\Core\Enums;

use App\Core\Services\CacheService;

interface CacheKeys
{
    public const APP_KEY = 'APP_NAME';

    public const USER = self::APP_KEY . '_USER_';

}