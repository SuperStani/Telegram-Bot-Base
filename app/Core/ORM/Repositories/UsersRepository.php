<?php


namespace App\Core\ORM\Repositories;

use App\Configs\RedisConfigurations;
use App\Core\Enums\CacheKeys;
use App\Core\Enums\CacheKeysLifeTime;
use App\Core\ORM\Entities\UserEntity;

class UsersRepository extends AbstractRepository
{
    private static string $table = "users";

    public function insert(UserEntity $userEntity): void
    {
        $query = "INSERT INTO " . self::$table . " SET id = ?, page = ?, lang = ?, last_update = NOW() 
          ON DUPLICATE KEY UPDATE last_update = NOW()";
        $this->db->query($query, $userEntity->getId(), $userEntity->getPage(), $userEntity->getLang());
    }

    public function update(UserEntity $user)
    {

    }

    public function updatePageByUserId(int $userId, int|string $text): void
    {
        $query = "UPDATE " . self::$table . " SET page = ? WHERE id = ?";
        $this->db->query($query, $text, $userId);
        $user = $this->getUserById($userId);
        $user?->setPage($text);
        $this->cacheService->setKey(CacheKeys::USER . $userId, serialize($user), CacheKeysLifeTime::USER);
    }

    public function updateLangByUserId(string $lang, int $userId): void
    {
        $query = "UPDATE " . self::$table . " SET lang = ? WHERE id = ?";
        $this->db->query($query, $lang, $userId);
        $user = $this->getUserById($userId);
        $user?->setLang($lang);
        if ($user !== null) {
            $this->cacheService->setKey(CacheKeys::USER . $userId, serialize($user), CacheKeysLifeTime::USER);
        }
    }


    public function getUserById(int $userId): ?UserEntity
    {
        if (($user = unserialize($this->cacheService->getKey(CacheKeys::USER . $userId))) === false) {
            $query = "SELECT id, page, lang FROM " . self::$table . " WHERE id = ?";
            $res = $this->db->query($query, $userId)->fetch();
            if (isset($res['id'])) {
                $user = new UserEntity();
                $user->setId($res['id']);
                $user->setLang($res['lang']);
                $user->setPage($res['page']);
                $this->cacheService->setKey(CacheKeys::USER . $userId, serialize($user), CacheKeysLifeTime::USER);
            } else {
                return null;
            }
        }
        return $user;
    }

}