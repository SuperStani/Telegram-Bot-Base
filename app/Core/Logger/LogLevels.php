<?php


namespace App\Core\Logger;

use ReflectionClass;
use ReflectionException;

class LogLevels
{

    public const DEBUG = 0;

    public const INFO = 1;

    public const WARNING = 2;

    public const ERROR = 3;

    public const CRITICAL = 99;

    public const UNKNOWN = -1;

    public static function toString($val): string
    {
        try {
            $classEnum = new ReflectionClass(static::class);

            $constants = array_flip($classEnum->getConstants());
            if (!isset($constants[$val])) {
                return $constants[self::UNKNOWN];
            }
            return $constants[$val];
        } catch (ReflectionException $e) {
            syslog(LOG_ERR, json_encode($e));
            return 'CRITICAL';
        }
    }
}
