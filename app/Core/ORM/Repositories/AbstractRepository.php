<?php


namespace App\Core\ORM\Repositories;


use App\Core\ORM\DB;
use App\Core\Services\CacheService;

abstract class AbstractRepository
{
    protected DB $db;
    protected CacheService $cacheService;

    public function __construct(DB $db, CacheService $cacheService)
    {
        $this->db = $db;
        $this->cacheService = $cacheService;
    }

}