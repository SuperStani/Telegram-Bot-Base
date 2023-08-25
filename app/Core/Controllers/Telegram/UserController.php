<?php

namespace App\Core\Controllers\Telegram;

use App\Configs\GeneralConfigurations;
use App\Core\Services\CacheService;
use App\Integration\Telegram\Enums\User;
use App\Core\ORM\Repositories\UsersRepository;


class UserController
{
    private User $user;
    private UsersRepository $usersRepository;
    private CacheService $cacheService;

    public function __construct(
        User $user,
        UsersRepository $userRepo,
        CacheService $cacheService
    )
    {
        $this->user = $user;
        $this->usersRepository = $userRepo;
        $this->cacheService = $cacheService;
    }

    public function save()
    {
        try {
            $this->usersRepository->save($this->user->id);
        } catch (\Exception $e) {

        }
    }

    public function update()
    {
        $this->usersRepository->updateLastAction($this->user->id);
    }

    public function page($text = '')
    {
        $this->cacheService->setUserPage($this->user->id, $text);
        $this->usersRepository->page($this->user->id, $text);
    }

    public function getPage(): ?string
    {
        if (($page = $this->cacheService->getUserPage($this->user->id)) == false) {
            $page = $this->usersRepository->getPage($this->user->id);
        }
        return $page;
    }

    public function isAdmin(): bool
    {
        return in_array($this->user->id, GeneralConfigurations::ADMINS);
    }
}
