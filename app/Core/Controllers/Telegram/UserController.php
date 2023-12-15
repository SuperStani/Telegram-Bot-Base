<?php

namespace App\Core\Controllers\Telegram;

use App\Configs\GeneralConfigurations;
use App\Core\ORM\Entities\UserEntity;
use App\Core\ORM\Repositories\UsersRepository;
use App\Integrations\Telegram\Enums\User;
use Exception;


class UserController
{
    private User $user;
    private UsersRepository $usersRepository;

    public function __construct(
        User $user,
        UsersRepository $userRepo
    )
    {
        $this->user = $user;
        $this->usersRepository = $userRepo;
    }

    public function save(): int
    {
        try {
            $user = new UserEntity();
            $user->setId($this->user->id);
            $this->usersRepository->insert($user);
            return $user->getId();
        } catch (Exception $e) {
            return 0;
        }
    }

    public function page($text = '')
    {
        $this->usersRepository->updatePageByUserId($this->user->id, $text);
    }

    public function getPage(): ?string
    {
        return $this->usersRepository->getPageByUserId($this->user->id);
    }

    public function isAdmin(): bool
    {
        return in_array($this->user->id, GeneralConfigurations::ADMINS);
    }
}
