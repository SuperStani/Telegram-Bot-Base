<?php

namespace App\Integrations\Telegram;

use App\Configs\GeneralConfigurations;
use GuzzleHttp\Exception\GuzzleException;

use GuzzleHttp\Client;

class Request
{
    private static ?Client $client = null;

    private static function getClient(): Client
    {
        if (self::$client === null) {
            self::$client = new Client();
        }
        return self::$client;
    }

    public static function get(string $method, array $args = [], $bot_token = null): ?array
    {
        $http = self::getClient();
        $query_params = http_build_query($args);
        $endpoint = "https://api.telegram.org/bot" . ($bot_token ?? GeneralConfigurations::BOT_TOKEN) . "/" . $method . "?" . $query_params;
        try {
            $res = $http->get($endpoint, ["timeout" => 5, "connect_timeout" => 2]);
            if ($res->getStatusCode() == 200) {
                $result = json_decode($res->getBody(), true);
            } else {
                $result = [
                    "ok" => false,
                    "error_code" => $res->getStatusCode(),
                    "description" => "Bad request!"
                ];
            }
        } catch (GuzzleException | \Exception $e) {
            $result = [
                "ok" => false,
                "error_code" => $e->getCode(),
                "description" => $e->getMessage(),
                "curl_error" => true
            ];
        }

        return $result;
    }
}
