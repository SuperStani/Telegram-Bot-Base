<?php


namespace App\Core\Logger;

use App\Configs\GeneralConfigurations;

class Logger implements LoggerInterface
{
    private static int $defaultBiMask = LoggingDestination::LOG_TO_FILE;

    private static string $delimiter = "  ";

    protected const DATETIME_FORMAT = "Y-m-d H:i:s";

    public function debug(string $message, ?string $optional = null, ?string $dataText = null, ?int $bit_mask = null)
    {
        $this->makeLog(LogLevels::DEBUG, $message, $optional, $dataText, $bit_mask ?? self::$defaultBiMask);
    }

    public function info(string $message, ?string $optional = null, ?string $dataText = null, ?int $bit_mask = null)
    {
        $this->makeLog(LogLevels::INFO, $message, $optional, $dataText, $bit_mask ?? self::$defaultBiMask);
    }

    public function warning(string $message, ?string $optional = null, ?string $dataText = null, ?int $bit_mask = null)
    {
        $this->makeLog(LogLevels::WARNING, $message, $optional, $dataText, $bit_mask ?? self::$defaultBiMask);
    }

    public function error(string $message, ?string $optional = null, ?string $dataText = null, ?int $bit_mask = null)
    {
        $this->makeLog(LogLevels::ERROR, $message, $optional, $dataText, $bit_mask ?? self::$defaultBiMask);
    }

    public function critical(string $message, ?string $optional = null, ?string $dataText = null, ?int $bit_mask = null)
    {
        $this->makeLog(LogLevels::CRITICAL, $message, $optional, $dataText, $bit_mask ?? self::$defaultBiMask);
    }

    protected function makeLog(int $logLevel, string $message, ?string $optional, ?string $dataText, ?int $bit_mask)
    {
        $data = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 3);
        $file = $data[2]['file'] ?? '';
        $function = $data[2]['function'] ?? '';

        switch ($bit_mask) {
            case LoggingDestination::LOG_TO_SYSLOG:
                {
                    $this->logToSyslog($logLevel, $file, $function, $message, $optional, $dataText);
                }
                break;
            case LoggingDestination::LOG_TO_FILE:
                {
                    $this->logToFile($logLevel, $file, $function, $message, $optional, $dataText);
                }
                break;
        }

    }

    protected function prepareMessageLog(string $file, string $function, string $message, ?string $optional, ?string $dataText, ?int $logLevel): string
    {
        $delimiter = self::$delimiter;

        if ($logLevel > LogLevels::INFO) {
            return "{$file}{$delimiter}{$function}{$delimiter}{$message}{$delimiter}{$optional}{$delimiter}{$dataText}";
        } else {
            return "{$message}{$delimiter}{$optional}{$delimiter}{$dataText}";
        }
    }

    protected function logToSyslog(int $logLevel, string $file, string $function, string $message, ?string $optional, ?string $dataText)
    {
        try {
            $logText = self::$delimiter . LogLevels::toString($logLevel) . self::$delimiter;
            $logText .= $this->prepareMessageLog($file, $function, $message, $optional, $dataText, $logLevel);
            switch ($logLevel) {
                case LogLevels::DEBUG:
                    syslog(LOG_DEBUG, $logText);
                    break;
                case LogLevels::INFO:
                    syslog(LOG_INFO, $logText);
                    break;
                case LogLevels::WARNING:
                    syslog(LOG_WARNING, $logText);
                    break;
                case LogLevels::ERROR:
                    syslog(LOG_ERR, $logText);
                    break;
                case LogLevels::CRITICAL:
                    syslog(LOG_CRIT, $logText);
                    break;
            }
        } catch (\Exception $ex) {
            echo $ex->getMessage() . PHP_EOL;
        }
    }

    protected function logToFile(int $logLevel, string $file, string $function, string $message, ?string $optional, ?string $dataText)
    {
        try {
            $text = date(self::DATETIME_FORMAT) . self::$delimiter;
            $text .= $this->prepareMessageLog($file, $function, $message, $optional, $dataText, $logLevel) . PHP_EOL;
            if (is_dir(GeneralConfigurations::LOGGER_PATH) || mkdir(GeneralConfigurations::LOGGER_PATH)) {
                $bytes = file_put_contents(GeneralConfigurations::LOGGER_PATH . strtolower(LogLevels::toString($logLevel)) . '.log', $text, FILE_APPEND
                );
                if ($bytes === false) {
                    $this->logToSyslog($logLevel, $file, $function, $message, $optional, $dataText);
                    $this->critical("Could not write to file.", $file, null, LoggingDestination::LOG_TO_SYSLOG);
                }
            } else {
                $this->logToSyslog($logLevel, $file, $function, $message, $optional, $dataText);
                $this->critical(
                    "Directory is missing and could not create directory.",
                    $file,
                    null,
                    LoggingDestination::LOG_TO_SYSLOG
                );
            }
        } catch (\Exception $ex) {
            $this->logToSyslog($logLevel, $file, $function, $message, $optional, $dataText);
            $this->critical($ex->getMessage(), "Line: " . $ex->getLine(), null, LoggingDestination::LOG_TO_SYSLOG);
        }
    }
}