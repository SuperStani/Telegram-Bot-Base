<?php

namespace App\Core\Services;

use App\Core\Controllers\Cache\RedisController;
use App\Core\Logger\LoggerInterface;

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
        } catch (\Exception $e) {
            $this->logger->warning("SetUserPageCache failed!", $e->getMessage());
        }
    }

    public function getUserPage(int $user_id): string|bool
    {
        try {
            return $this->redisController->getKey("PAGE_" . $user_id);
        } catch (\Exception $e) {
            $this->logger->warning("GetUserPageCache failed!", $e->getMessage());
            return false;
        }
    }

}
