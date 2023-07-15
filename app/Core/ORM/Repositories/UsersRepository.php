<?php


namespace App\Core\ORM\Repositories;


use App\Core\ORM\DB;

class UsersRepository
{
    private DB $db;
    private static string $table = "Users";

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function page(int $user_id, string|int $text = '')
    {
        $query = "UPDATE " . self::$table . " SET page = ? WHERE id = ?";
        $this->db->query($query, $text, $user_id);
    }

    public function getPage(int $user_id): ?string
    {
        $query = "SELECT page FROM " . self::$table . " WHERE id = ?";
        return $this->db->query($query, $user_id)->fetch()['id'] ?? '';
    }

    public function save(int $user_id): bool
    {
        $query = "INSERT INTO " . self::$table . " SET id = ?";
        return $this->db->query($query, $user_id) != null;
    }

    public function updateLastAction(int $user_id): bool
    {
        $query = "UPDATE " . self::$table . " SET datetime_last_update = NOW() WHERE id = ?";
        return $this->db->query($query, $user_id) != null;
    }

}