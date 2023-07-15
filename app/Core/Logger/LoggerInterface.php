<?php


namespace App\Core\Logger;


interface LoggerInterface
{
    public function debug(string $message, ?string $optional = null, ?string $dataText = null, ?int $bit_mask = null);

    public function info(string $message, ?string $optional = null, ?string $dataText = null, ?int $bit_mask = null);

    public function warning(string $message, ?string $optional = null, ?string $dataText = null, ?int $bit_mask = null);

    public function error(string $message, ?string $optional = null, ?string $dataText = null, ?int $bit_mask = null);

    public function critical(string $message, ?string $optional = null, ?string $dataText = null, ?int $bit_mask = null);
}