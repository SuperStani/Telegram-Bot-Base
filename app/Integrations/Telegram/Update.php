<?php

namespace App\Integrations\Telegram;

class Update
{
    private mixed $update;
    private string $type;

    public function __construct(mixed $update, string $type)
    {
        $this->update = $update;
        $this->type = $type;
    }

    public function getUpdate()
    {
        return $this->update;
    }

    public function setUpdate($update)
    {
        $this->update = $update;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public static function get(): ?\stdClass
    {
        return json_decode(file_get_contents("php://input"));
    }

    public static function getFakeMessage(): array
    {
        $update = '{
              "update_id": 144168434,
              "message": {
                "message_id": 640265,
                "from": {
                  "id": 406343901,
                  "is_bot": false,
                  "first_name": "『 Sᴛᴀɴɪ 』",
                  "username": "SuperStani",
                  "language_code": "it"
                },
                "chat": {
                  "id": 406343901,
                  "first_name": "『 Sᴛᴀɴɪ 』",
                  "username": "SuperStani",
                  "type": "private"
                },
                "date": 1658333314,
                "text": "gg"
              }
          }';
        return json_decode($update);
    }

    public static function getFakeStart(): array
    {
        $update = '{
              "update_id": 144166896,
              "message": {
                "message_id": 637132,
                "from": {
                  "id": 406343901,
                  "is_bot": false,
                  "first_name": "『 Sᴛᴀɴɪ 』",
                  "username": "SuperStani",
                  "language_code": "it"
                },
                "chat": {
                  "id": 406343901,
                  "first_name": "『 Sᴛᴀɴɪ 』",
                  "username": "SuperStani",
                  "type": "private"
                },
                "date": 1657981201,
                "text": "/start",
                "entities": [
                  {
                    "offset": 0,
                    "length": 6,
                    "type": "bot_command"
                  }
                ]
              }
          }';
        return json_decode($update);
    }

    public static function getFakeUpdate($user, $data)
    {
        $update = '{
            "callback_query": {
                "id": "1745233767981526489",
                "from": {
                    "id": ' . $user . ',
                    "is_bot": false,
                    "first_name": "\u300e S\u1d1b\u1d00\u0274\u026a \u300f",
                    "username": "SuperStani",
                    "language_code": "it"
                },
                "message": {
                    "message_id": 4511,
                    "from": {
                        "id": 5372846548,
                        "is_bot": true,
                        "first_name": "MY ANIME TV BETA",
                        "username": "myanimetvbetabot"
                    },
                    "chat": {
                        "id": ' . $user . ',
                        "first_name": "\u300e S\u1d1b\u1d00\u0274\u026a \u300f",
                        "username": "SuperStani",
                        "type": "private"
                    },
                    "date": 1658525197,
                    "text": "Classifica",
                    "reply_markup": {
                        "inline_keyboard": [
                            [
                                {
                                    "text": "CLASSIFICA VOTI",
                                    "callback_data": "Leadership:byVotes|0"
                                }
                            ]
                        ]
                    }
                },
                "data": "' . $data . '"
            }
          }';
        return json_decode($update);
    }
}
