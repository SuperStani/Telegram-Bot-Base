<?php

namespace App\Core\Services;

use App\Core\Controllers\Cache\RedisController;
use App\Core\Logger\LoggerInterface;
use Exception;

class CacheService
{
    private RedisController $redisController;

    private LoggerInterface $logger;

    public function __construct(
        RedisController $connection,
        LoggerInterface $logger
    )
    {
        $this->redisController = $connection;
        $this->logger = $logger;
    }

    public function setUserPage(int $user_id, string|int $page)
    {
        try {
            $this->redisController->setKey("PAGE_" . $user_id, $page, "60");
        } catch (Exception $e) {
            $this->logger->warning("SetUserPageCache failed!", $e->getMessage());
        }
    }

    public function getUserPage(int $user_id): string|bool
    {
        try {
            return $this->redisController->getKey("PAGE_" . $user_id);
        } catch (Exception $e) {
            $this->logger->warning("GetUserPageCache failed!", $e->getMessage());
            return false;
        }
    }

    public function setKey(string $key, string $value, int $expire_time = null)
    {
        try {
            $this->redisController->setKey($key, $value, $expire_time);
        } catch (Exception $e) {

        }
    }

    public function getKey(string $key): false|string|int
    {
        try {
            return $this->redisController->getKey($key);
        } catch (Exception $e) {
            $this->logger->warning("Redis get key error", $e->getMessage());
            return false;
        }
    }

}
