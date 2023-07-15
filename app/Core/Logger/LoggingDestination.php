<?php


namespace App\Core\Logger;


interface LoggingDestination
{
    public const LOG_TO_SYSLOG = 1;

    public const LOG_TO_FILE = 2;
}
