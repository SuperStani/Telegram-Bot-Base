<?php

namespace App\Core\Controllers;

class RedisController
{

    private string $host;

    private int $port;

    private ?string $socket;

    private ?\Redis $redisInstance;

    public function __construct(string $host, int $port, ?string $socket = null)
    {
        $this->host = $host;
        $this->port = $port;
        $this->socket = $socket;
        $this->redisInstance = null;
    }

    private function initialize()
    {
        if ($this->redisInstance == null) {
            $this->redisInstance = new \Redis();
            if ($this->socket !== null) {
                $this->redisInstance->connect($this->socket);
            } else {
                $this->redisInstance->connect($this->host, $this->port);
            }
        }
    }

    /**
     * @throws \Exception
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array(array(
            $this->getRedis(),
            $method
        ), $parameters);
    }

    /**
     * @throws \Exception
     */
    public function getRedis(): \Redis
    {
        $this->initialize();
        if ($this->redisInstance == null) {
            $this->initialize();
            if ($this->redisInstance == null) {
                throw new \Exception("Unable to init memcached to " . $this->host . ":" . $this->port);
            }
        }
        return $this->redisInstance;
    }

    /**
     * @throws \Exception
     */
    public function setKey($key, $value, $time = 86400) // 24 Hours
    {
        $this->getRedis()->set($key, $value);
        if ($time > 0) {
            $this->getRedis()->expire($key, $time);
        }
    }

    /**
     * @throws \Exception
     */
    public function addKey($key, $value, $time = 86400) // 24 Hours
    {
        if ($this->getRedis()->setnx($key, $value) && $time > 0) {
            $this->getRedis()->expire($key, $time);
        }
    }

    /**
     * @throws \Exception
     */
    public function dropKey($key)
    {
        $this->getRedis()->del($key);
    }

    /**
     * @throws \Exception
     */
    public function getKey($key)
    {
        return $this->getRedis()->get($key);
    }

    /**
     * @throws \Exception
     */
    public function incrementKey($key, $amount = 1): int
    {
        return $this->getRedis()->incrBy($key, $amount);
    }

    /**
     * @throws \Exception
     */
    public function decrementKey($key, $amount = 1, $negative = false): int
    {
        $result = $this->getRedis()->decrBy($key, $amount);
        if ($result < 0 && !$negative) {
            $result = $this->getRedis()->incrBy($key, ($result * -1));
            return 0;
        }
        return $result;
    }

    /**
     * @throws \Exception
     */
    public function replaceKey($key, $value, $time = 5)
    {
        $this->setKey($key, $value, $time);
    }
}