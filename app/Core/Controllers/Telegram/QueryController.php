<?php

namespace App\Core\Controllers\Telegram;

use App\Core\Logger\LoggerInterface;
use App\Integrations\Telegram\Enums\Query;


abstract class QueryController extends Controller
{
    protected Query $query;

    public function __construct(
        Query $query,
        UserController $user,
        LoggerInterface $logger
    )
    {
        parent::__construct($user, $logger);
        $this->query = $query;
    }
}
