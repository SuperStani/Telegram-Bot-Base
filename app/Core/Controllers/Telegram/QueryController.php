<?php

namespace App\Core\Controllers\Telegram;

use App\Core\Logger\LoggerInterface;
use App\Integrations\Telegram\Query;


abstract class QueryController extends Controller
{
    protected Query $query;
    protected LoggerInterface $logger;

    public function __construct(
        Query $query,
        UserController $user,
        LoggerInterface $logger
    )
    {
        $this->query = $query;
        $this->user = $user;
        $this->logger = $logger;
    }
}
