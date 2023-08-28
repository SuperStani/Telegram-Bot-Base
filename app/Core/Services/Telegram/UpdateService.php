<?php


namespace App\Core\Services\Telegram;


use App\Integrations\Telegram\Enums\Update;

class UpdateService
{

    public static function get(): ?Update
    {
        if (($update = WebAppService::getUpdateFromWebApp()) === false) {
            return new Update(json_decode(file_get_contents("php://input")));
        }
        return $update;
    }

    public static function getFakeUpdateQuery($user, $data): Update
    {
        $update = '{
            "callback_query": {
                "id": "1745233767981526489",
                "from": {
                    "id": ' . $user . ',
                    "is_bot": false,
                    "first_name": "",
                    "username": "",
                    "language_code": ""
                },
                "message": {
                    "message_id": 4511,
                    "from": {
                        "id": 5372846548,
                        "is_bot": true,
                        "first_name": "",
                        "username": ""
                    },
                    "chat": {
                        "id": ' . $user . ',
                        "first_name": "",
                        "username": "",
                        "type": "private"
                    },
                    "date": 1658525197,
                    "text": "Fake update"
                },
                "data": "' . $data . '"
            }
          }';
        return new Update(json_decode($update));
    }
}