<?php

namespace App\Core\Controllers\Telegram;

use App\Configs\GeneralConfigurations;
use App\Core\Services\CacheService;
use App\Integrations\Telegram\TelegramClient;
use App\Core\ORM\Repositories\UsersRepository;
use App\Integrations\Telegram\Update;


class UserController extends Controller
{
    public int $id;
    public string $name;
    public string $mention;
    private UsersRepository $usersRepository;
    private CacheService $cacheService;

    public function __construct(
        Update $user,
        UsersRepository $userRepo,
        CacheService $cacheService
    )
    {
        $user = $user->getUpdate();
        $this->id = $user->from->id;
        $this->name = $user->from->first_name;
        $this->mention = "[" . $user->from->first_name . "](tg://user?id=" . $user->from->id . ")";
        $this->usersRepository = $userRepo;
        $this->cacheService = $cacheService;
    }

    public function getMe(): ?array
    {
        return TelegramClient::getChat($this->id)['result'] ?? null;
    }

    public function save()
    {
        try {
            $this->usersRepository->save($this->id);
        } catch (\Exception $e) {

        }
    }

    public function update()
    {
        $this->usersRepository->updateLastAction($this->id);
    }

    public function page($text = '')
    {
        $this->cacheService->setUserPage($this->id, $text);
        $this->usersRepository->page($this->id, $text);
    }

    public function getPage(): ?string
    {
        if (($page = $this->cacheService->getUserPage($this->id)) == false) {
            $page = $this->usersRepository->getPage($this->id);
        }
        return $page;
    }

    public function isAdmin(): bool
    {
        return in_array($this->id, GeneralConfigurations::ADMINS);
    }
}
