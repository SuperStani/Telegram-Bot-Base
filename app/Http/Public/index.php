<?php

use App\Configs\GeneralConfigurations;
use App\Core\Routing\Route;
use App\Integrations\Telegram\Update;

header('Access-Control-Allow-Origin: *');
ini_set('display_errors', true);
error_reporting(E_ALL);
require_once __DIR__ . "/../../../vendor/autoload.php";
require __DIR__ . "/../../Langs/getlang.php";


//WebApp update
if (isset($_GET["webapp"], $_GET["hash"], $_GET["to_user"], $_GET["movie"])) {
    $check_hash = $_GET["hash"];
    $movie = $_GET["movie"];
    $user = $_GET["to_user"];
    /*--------------------------------|
    |--Check if data is from web app--|
    |--------------------------------*/
    unset($_GET["webapp"], $_GET["hash"], $_GET["to_user"], $_GET["movie"]);

    if (isset($_GET["episode"])) {
        $isEpisode = $_GET["episode"];
        unset($_GET["episode"]);
    }

    $data_check_arr = [];
    foreach ($_GET as $key => $value) {
        $data_check_arr[] = $key . '=' . $value;
    }
    sort($data_check_arr);
    $data_check_string = implode("\n", $data_check_arr);
    $secret_key = hash_hmac('sha256', GeneralConfigurations::BOT_TOKEN, "WebAppData", true);
    $hash = hash_hmac('sha256', $data_check_string, $secret_key);

    if (strcmp($hash, $check_hash) === 0 and (time() - $_GET["auth_date"]) < 86400) {
        if (isset($isEpisode))
            $update = Update::getFakeUpdate($user, "Player:play|$movie|$isEpisode|-1");
        else
            $update = Update::getFakeUpdate($user, "Movie:view|$movie");
        $update = new Update($update->callback_query, 'callback_query');
    } else //Fake update
        die();
} else {//Bot update
    $update = Update::get();
    if (isset($update->callback_query)) {
        $type = 'callback_query';
    } elseif (isset($update->message)) {
        $type = 'message';
    } elseif (isset($update->inline_query)) {
        $type = 'inline_query';
    } else {
        $type = 'Unknow';
    }
    $update = new Update($update->{$type} ?? $update, $type);
}

Route::processUpdate($update);
