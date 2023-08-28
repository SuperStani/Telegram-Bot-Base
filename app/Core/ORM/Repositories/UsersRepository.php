<?php


namespace App\Core\ORM\Repositories;

use App\Core\ORM\Entities\UserEntity;

class UsersRepository extends AbstractRepository
{
    private static string $table = "Users";

    public function insert(UserEntity $userEntity): void
    {
        $query = "INSERT INTO " . self::$table . " SET id = ?, page = ?";
        $this->db->query($query, $userEntity->getId(), $userEntity->getPage());
        $userEntity->setId($this->db->getLastInsertId());
    }

    public function update(UserEntity $user)
    {

    }

    public function updatePageByUserId(int $user_id, int|string $text)
    {
        $query = "UPDATE " . self::$table . " SET page = ? WHERE id = ?";
        $this->db->query($query, $text, $user_id);
        $this->cacheService->setKey(self::class . "|page:$user_id", $text, 30);
    }

    public function getPageByUserId(int $user_id): ?string
    {
        if (($page = $this->cacheService->getKey(self::class . "|page:$user_id")) === false) {
            $query = "SELECT page FROM " . self::$table . " WHERE id = ?";
            return $this->db->query($query, $user_id)->fetch()['page'] ?? '';
        }
        return $page;
    }

}