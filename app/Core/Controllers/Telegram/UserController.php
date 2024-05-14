<?php

namespace App\Core\Controllers\Telegram;

use App\Configs\GeneralConfigurations;
use App\Core\Logger\LoggerInterface;
use App\Core\ORM\Entities\UserEntity;
use App\Core\ORM\Repositories\UsersRepository;
use App\Integrations\Telegram\Enums\User;
use Exception;


class UserController
{
    private User $user;
    private UsersRepository $usersRepository;
    private LoggerInterface $logger;

    public function __construct(
        User            $user,
        UsersRepository $userRepo,
        LoggerInterface $logger
    )
    {
        $this->user = $user;
        $this->usersRepository = $userRepo;
        $this->logger = $logger;
    }

    public function save(): int
    {

        $user = new UserEntity();
        $user->setId($this->user->id);
        $user->setPage(GeneralConfigurations::DEFAULT_USER_PAGE);
        $user->setLang($this->user->language_code ?? GeneralConfigurations::DEFAULT_LANG);
        $this->usersRepository->insert($user);
        return $user->getId();
    }

    public function page(string $text = GeneralConfigurations::DEFAULT_USER_PAGE): void
    {
        $this->usersRepository->updatePageByUserId($this->user->id, $text);
    }

    public function getPage(): ?string
    {
        if (($user = $this->usersRepository->getUserById($this->user->id)) !== null) {
            return $user->getPage();
        } else {
            $this->save();
            $this->logger->warning('Cannot get page of user', $this->user->id, json_encode($this->user));
            return GeneralConfigurations::DEFAULT_USER_PAGE;
        }
    }

    public function isAdmin(): bool
    {
        return in_array($this->user->id, GeneralConfigurations::ADMINS);
    }

    public function getId(): int
    {
        return $this->user->id;
    }

    public function getName(): string
    {
        return $this->user->first_name;
    }

    public function getLang(): string
    {
        if (($user = $this->usersRepository->getUserById($this->user->id)) !== null) {
            return $user->getLang();
        } else {
            $this->save();
            $this->logger->warning('Cannot get language of user', $this->user->id, json_encode($this->user));
            return $this->user->language_code ?? GeneralConfigurations::DEFAULT_LANG;
        }
    }

    public function setLang(string $lang): void
    {
        $this->usersRepository->updateLangByUserId($lang, $this->user->id);
    }

    public function getMention(): string
    {
        return $this->user->getMention();
    }
}
