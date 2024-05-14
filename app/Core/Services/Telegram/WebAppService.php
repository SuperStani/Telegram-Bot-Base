<?php


namespace App\Core\Services\Telegram;


use App\Configs\GeneralConfigurations;
use App\Integrations\Telegram\Enums\Update;

class WebAppService
{
    public static function getUpdateFromWebApp(): Update|false
    {
        $check_hash = $_GET["hash"] ?? null;
        if ($check_hash === null) {
            return false;
        }
        $callback_data = $_GET["callback_data"] ?? null;
        $user = $_GET["to_user"] ?? null;
        unset($_GET["callback_data"], $_GET["to_user"], $_GET['hash'], $_GET['webapp']);
        $data_check_arr = [];
        foreach ($_GET as $key => $value) {
            $data_check_arr[] = $key . '=' . $value;
        }
        sort($data_check_arr);
        $data_check_string = implode("\n", $data_check_arr);
        $secret_key = hash_hmac('sha256', GeneralConfigurations::BOT_TOKEN, "WebAppData", true);
        $hash = hash_hmac('sha256', $data_check_string, $secret_key);

        if (strcmp($hash, $check_hash) === 0 and (time() - $_GET["auth_date"]) < 86400) {
            return UpdateService::getFakeUpdateQuery($user, $callback_data);
        }
        return false;
    }
}