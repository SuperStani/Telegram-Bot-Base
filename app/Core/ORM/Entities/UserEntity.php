<?php

namespace App\Core\ORM\Entities;

class UserEntity extends AbstractEntity
{
    public int $id;

    public string|int $page;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|string
     */
    public function getPage(): int|string
    {
        return $this->page;
    }

    /**
     * @param int|string $page
     */
    public function setPage(int|string $page): void
    {
        $this->page = $page;
    }
}