<?php

namespace App\Integrations\Telegram;


use CURLFile;

abstract class Api
{

    public static function getUpdates(
        int   $offset = null,
        int   $limit = null,
        int   $timeout = null,
        array $allowed_updates = null
    ): ?array
    {
        $args = [];

        if ($offset !== null) {
            $args['offset'] = $offset;
        }

        if ($limit !== null) {
            $args['limit'] = $limit;
        }

        if ($timeout !== null) {
            $args['timeout'] = $timeout;
        }

        if ($allowed_updates !== null) {
            $args['allowed_updates'] = json_encode($allowed_updates);
        }

        return Request::get('getUpdates', $args);
    }

    public static function setWebhook(
        string   $url,
        CURLFile $certificate = null,
        string   $ip_address = null,
        int      $max_connections = null,
        array    $allowed_updates = null,
        bool     $drop_pending_updates = null
    ): ?array
    {
        $args = [
            'url' => $url
        ];

        if ($certificate !== null) {
            $args['certificate'] = $certificate;
        }

        if ($ip_address !== null) {
            $args['ip_address'] = $ip_address;
        }

        if ($max_connections !== null) {
            $args['max_connections'] = $max_connections;
        }

        if ($allowed_updates !== null) {
            $args['allowed_updates'] = json_encode($allowed_updates);
        }

        if ($drop_pending_updates !== null) {
            $args['drop_pending_updates'] = $drop_pending_updates;
        }

        return Request::get('setWebhook', $args);
    }

    public static function deleteWebhook(
        bool $drop_pending_updates = null
    ): ?array
    {
        $args = [];

        if ($drop_pending_updates !== null) {
            $args['drop_pending_updates'] = $drop_pending_updates;
        }

        return Request::get('deleteWebhook', $args);
    }

    public static function getWebhookInfo(): ?array
    {
        return Request::get('getWebhookInfo', []);
    }

    public static function getMe(): ?array
    {
        return Request::get('getMe', []);
    }

    public static function logOut(): ?array
    {
        return Request::get('logOut', []);
    }

    public static function close(): ?array
    {
        return Request::get('close', []);
    }

    public static function sendMessage(
        $chat_id,
        string $text,
        string $parse_mode = null,
        array $entities = null,
        bool $disable_web_page_preview = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        array $reply_markup = null,
        string $bot_token = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'text' => $text
        ];

        if ($parse_mode !== null) {
            $args['parse_mode'] = $parse_mode;
        }

        if ($entities !== null) {
            $args['entities'] = json_encode($entities);
        }

        if ($disable_web_page_preview !== null) {
            $args['disable_web_page_preview'] = $disable_web_page_preview;
        }

        if ($disable_notification !== null) {
            $args['disable_notification'] = $disable_notification;
        }

        if ($protect_content !== null) {
            $args['protect_content'] = $protect_content;
        }

        if ($reply_to_message_id !== null) {
            $args['reply_to_message_id'] = $reply_to_message_id;
        }

        if ($allow_sending_without_reply !== null) {
            $args['allow_sending_without_reply'] = $allow_sending_without_reply;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('sendMessage', $args, $bot_token);
    }

    public static function forwardMessage(
        $chat_id,
        $from_chat_id,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $message_id = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'from_chat_id' => $from_chat_id
        ];

        if ($disable_notification !== null) {
            $args['disable_notification'] = $disable_notification;
        }

        if ($protect_content !== null) {
            $args['protect_content'] = $protect_content;
        }

        if ($message_id !== null) {
            $args['message_id'] = $message_id;
        }

        return Request::get('forwardMessage', $args);
    }

    public static function copyMessage(
        $chat_id,
        $from_chat_id,
        int $message_id,
        string $caption = null,
        array $reply_markup = null,
        string $parse_mode = null,
        array $caption_entities = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'from_chat_id' => $from_chat_id,
            'message_id' => $message_id
        ];

        if ($caption !== null) {
            $args['caption'] = $caption;
        }

        if ($parse_mode !== null) {
            $args['parse_mode'] = $parse_mode;
        }

        if ($caption_entities !== null) {
            $args['caption_entities'] = json_encode($caption_entities);
        }

        if ($disable_notification !== null) {
            $args['disable_notification'] = $disable_notification;
        }

        if ($protect_content !== null) {
            $args['protect_content'] = $protect_content;
        }

        if ($reply_to_message_id !== null) {
            $args['reply_to_message_id'] = $reply_to_message_id;
        }

        if ($allow_sending_without_reply !== null) {
            $args['allow_sending_without_reply'] = $allow_sending_without_reply;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode(["inline_keyboard" => $reply_markup]);
        }

        return Request::get('copyMessage', $args);
    }

    public static function sendPhoto(
        $chat_id,
        $photo,
        string $caption = null,
        ?array $reply_markup = null,
        ?string $parse_mode = null,
        ?array $caption_entities = null,
        ?bool $disable_notification = null,
        ?bool $protect_content = null,
        ?int $reply_to_message_id = null,
        ?bool $allow_sending_without_reply = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'photo' => $photo
        ];

        if ($caption !== null) {
            $args['caption'] = $caption;
        }

        if ($parse_mode !== null) {
            $args['parse_mode'] = $parse_mode;
        }

        if ($caption_entities !== null) {
            $args['caption_entities'] = json_encode($caption_entities);
        }

        if ($disable_notification !== null) {
            $args['disable_notification'] = $disable_notification;
        }

        if ($protect_content !== null) {
            $args['protect_content'] = $protect_content;
        }

        if ($reply_to_message_id !== null) {
            $args['reply_to_message_id'] = $reply_to_message_id;
        }

        if ($allow_sending_without_reply !== null) {
            $args['allow_sending_without_reply'] = $allow_sending_without_reply;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode(["inline_keyboard" => $reply_markup]);
        }

        return Request::get('sendPhoto', $args);
    }

    public static function sendAudio(
        $chat_id,
        $audio,
        string $caption = null,
        string $parse_mode = null,
        array $caption_entities = null,
        int $duration = null,
        string $performer = null,
        string $title = null,
        $thumb = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        array $reply_markup = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'audio' => $audio
        ];

        if ($caption !== null) {
            $args['caption'] = $caption;
        }

        if ($parse_mode !== null) {
            $args['parse_mode'] = $parse_mode;
        }

        if ($caption_entities !== null) {
            $args['caption_entities'] = json_encode($caption_entities);
        }

        if ($duration !== null) {
            $args['duration'] = $duration;
        }

        if ($performer !== null) {
            $args['performer'] = $performer;
        }

        if ($title !== null) {
            $args['title'] = $title;
        }

        if ($thumb !== null) {
            $args['thumb'] = $thumb;
        }

        if ($disable_notification !== null) {
            $args['disable_notification'] = $disable_notification;
        }

        if ($protect_content !== null) {
            $args['protect_content'] = $protect_content;
        }

        if ($reply_to_message_id !== null) {
            $args['reply_to_message_id'] = $reply_to_message_id;
        }

        if ($allow_sending_without_reply !== null) {
            $args['allow_sending_without_reply'] = $allow_sending_without_reply;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('sendAudio', $args);
    }

    public static function sendDocument(
        $chat_id,
        $document,
        $thumb = null,
        string $caption = null,
        string $parse_mode = null,
        array $caption_entities = null,
        bool $disable_content_type_detection = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        array $reply_markup = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'document' => $document
        ];

        if ($thumb !== null) {
            $args['thumb'] = $thumb;
        }

        if ($caption !== null) {
            $args['caption'] = $caption;
        }

        if ($parse_mode !== null) {
            $args['parse_mode'] = $parse_mode;
        }

        if ($caption_entities !== null) {
            $args['caption_entities'] = json_encode($caption_entities);
        }

        if ($disable_content_type_detection !== null) {
            $args['disable_content_type_detection'] = $disable_content_type_detection;
        }

        if ($disable_notification !== null) {
            $args['disable_notification'] = $disable_notification;
        }

        if ($protect_content !== null) {
            $args['protect_content'] = $protect_content;
        }

        if ($reply_to_message_id !== null) {
            $args['reply_to_message_id'] = $reply_to_message_id;
        }

        if ($allow_sending_without_reply !== null) {
            $args['allow_sending_without_reply'] = $allow_sending_without_reply;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('sendDocument', $args);
    }

    public static function sendVideo(
        $chat_id,
        $video,
        int $duration = null,
        int $width = null,
        int $height = null,
        $thumb = null,
        string $caption = null,
        string $parse_mode = null,
        array $caption_entities = null,
        bool $supports_streaming = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        array $reply_markup = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'video' => $video
        ];

        if ($duration !== null) {
            $args['duration'] = $duration;
        }

        if ($width !== null) {
            $args['width'] = $width;
        }

        if ($height !== null) {
            $args['height'] = $height;
        }

        if ($thumb !== null) {
            $args['thumb'] = $thumb;
        }

        if ($caption !== null) {
            $args['caption'] = $caption;
        }

        if ($parse_mode !== null) {
            $args['parse_mode'] = $parse_mode;
        }

        if ($caption_entities !== null) {
            $args['caption_entities'] = json_encode($caption_entities);
        }

        if ($supports_streaming !== null) {
            $args['supports_streaming'] = $supports_streaming;
        }

        if ($disable_notification !== null) {
            $args['disable_notification'] = $disable_notification;
        }

        if ($protect_content !== null) {
            $args['protect_content'] = $protect_content;
        }

        if ($reply_to_message_id !== null) {
            $args['reply_to_message_id'] = $reply_to_message_id;
        }

        if ($allow_sending_without_reply !== null) {
            $args['allow_sending_without_reply'] = $allow_sending_without_reply;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('sendVideo', $args);
    }

    public static function sendAnimation(
        $chat_id,
        $animation,
        int $duration = null,
        int $width = null,
        int $height = null,
        $thumb = null,
        string $caption = null,
        string $parse_mode = null,
        array $caption_entities = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        array $reply_markup = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'animation' => $animation
        ];

        if ($duration !== null) {
            $args['duration'] = $duration;
        }

        if ($width !== null) {
            $args['width'] = $width;
        }

        if ($height !== null) {
            $args['height'] = $height;
        }

        if ($thumb !== null) {
            $args['thumb'] = $thumb;
        }

        if ($caption !== null) {
            $args['caption'] = $caption;
        }

        if ($parse_mode !== null) {
            $args['parse_mode'] = $parse_mode;
        }

        if ($caption_entities !== null) {
            $args['caption_entities'] = json_encode($caption_entities);
        }

        if ($disable_notification !== null) {
            $args['disable_notification'] = $disable_notification;
        }

        if ($protect_content !== null) {
            $args['protect_content'] = $protect_content;
        }

        if ($reply_to_message_id !== null) {
            $args['reply_to_message_id'] = $reply_to_message_id;
        }

        if ($allow_sending_without_reply !== null) {
            $args['allow_sending_without_reply'] = $allow_sending_without_reply;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('sendAnimation', $args);
    }

    public static function sendVoice(
        $chat_id,
        $voice,
        string $caption = null,
        string $parse_mode = null,
        array $caption_entities = null,
        int $duration = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        array $reply_markup = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'voice' => $voice
        ];

        if ($caption !== null) {
            $args['caption'] = $caption;
        }

        if ($parse_mode !== null) {
            $args['parse_mode'] = $parse_mode;
        }

        if ($caption_entities !== null) {
            $args['caption_entities'] = json_encode($caption_entities);
        }

        if ($duration !== null) {
            $args['duration'] = $duration;
        }

        if ($disable_notification !== null) {
            $args['disable_notification'] = $disable_notification;
        }

        if ($protect_content !== null) {
            $args['protect_content'] = $protect_content;
        }

        if ($reply_to_message_id !== null) {
            $args['reply_to_message_id'] = $reply_to_message_id;
        }

        if ($allow_sending_without_reply !== null) {
            $args['allow_sending_without_reply'] = $allow_sending_without_reply;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('sendVoice', $args);
    }

    public static function sendVideoNote(
        $chat_id,
        $video_note,
        int $duration = null,
        int $length = null,
        $thumb = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        array $reply_markup = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'video_note' => $video_note
        ];

        if ($duration !== null) {
            $args['duration'] = $duration;
        }

        if ($length !== null) {
            $args['length'] = $length;
        }

        if ($thumb !== null) {
            $args['thumb'] = $thumb;
        }

        if ($disable_notification !== null) {
            $args['disable_notification'] = $disable_notification;
        }

        if ($protect_content !== null) {
            $args['protect_content'] = $protect_content;
        }

        if ($reply_to_message_id !== null) {
            $args['reply_to_message_id'] = $reply_to_message_id;
        }

        if ($allow_sending_without_reply !== null) {
            $args['allow_sending_without_reply'] = $allow_sending_without_reply;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('sendVideoNote', $args);
    }

    public static function sendMediaGroup(
        $chat_id,
        array $media,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
        ];

        foreach ($media as $key => $value) {
            if (is_object($value['media'])) {
                $args['upload' . $key] = $value['media'];
                $media[$key]['media'] = 'attach://upload' . $key;
            }
        }
        $args['media'] = json_encode($media);

        if ($disable_notification !== null) {
            $args['disable_notification'] = $disable_notification;
        }

        if ($protect_content !== null) {
            $args['protect_content'] = $protect_content;
        }

        if ($reply_to_message_id !== null) {
            $args['reply_to_message_id'] = $reply_to_message_id;
        }

        if ($allow_sending_without_reply !== null) {
            $args['allow_sending_without_reply'] = $allow_sending_without_reply;
        }

        return Request::get('sendMediaGroup', $args);
    }

    public static function sendLocation(
        $chat_id,
        float $latitude,
        float $longitude,
        float $horizontal_accuracy = null,
        int $live_period = null,
        int $heading = null,
        int $proximity_alert_radius = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        array $reply_markup = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'latitude' => $latitude,
            'longitude' => $longitude
        ];

        if ($horizontal_accuracy !== null) {
            $args['horizontal_accuracy'] = $horizontal_accuracy;
        }

        if ($live_period !== null) {
            $args['live_period'] = $live_period;
        }

        if ($heading !== null) {
            $args['heading'] = $heading;
        }

        if ($proximity_alert_radius !== null) {
            $args['proximity_alert_radius'] = $proximity_alert_radius;
        }

        if ($disable_notification !== null) {
            $args['disable_notification'] = $disable_notification;
        }

        if ($protect_content !== null) {
            $args['protect_content'] = $protect_content;
        }

        if ($reply_to_message_id !== null) {
            $args['reply_to_message_id'] = $reply_to_message_id;
        }

        if ($allow_sending_without_reply !== null) {
            $args['allow_sending_without_reply'] = $allow_sending_without_reply;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('sendLocation', $args);
    }

    public static function editMessageLiveLocation(
        $chat_id = null,
        int $message_id = null,
        string $inline_message_id = null,
        float $latitude = null,
        float $longitude = null,
        float $horizontal_accuracy = null,
        int $heading = null,
        int $proximity_alert_radius = null,
        array $reply_markup = null
    ): ?array
    {
        $args = [];

        if ($chat_id !== null) {
            $args['chat_id'] = $chat_id;
        }

        if ($message_id !== null) {
            $args['message_id'] = $message_id;
        }

        if ($inline_message_id !== null) {
            $args['inline_message_id'] = $inline_message_id;
        }

        if ($latitude !== null) {
            $args['latitude'] = $latitude;
        }

        if ($longitude !== null) {
            $args['longitude'] = $longitude;
        }

        if ($horizontal_accuracy !== null) {
            $args['horizontal_accuracy'] = $horizontal_accuracy;
        }

        if ($heading !== null) {
            $args['heading'] = $heading;
        }

        if ($proximity_alert_radius !== null) {
            $args['proximity_alert_radius'] = $proximity_alert_radius;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('editMessageLiveLocation', $args);
    }

    public static function stopMessageLiveLocation(
        $chat_id = null,
        int $message_id = null,
        string $inline_message_id = null,
        array $reply_markup = null
    ): ?array
    {
        $args = [];

        if ($chat_id !== null) {
            $args['chat_id'] = $chat_id;
        }

        if ($message_id !== null) {
            $args['message_id'] = $message_id;
        }

        if ($inline_message_id !== null) {
            $args['inline_message_id'] = $inline_message_id;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('stopMessageLiveLocation', $args);
    }

    public static function sendVenue(
        $chat_id,
        float $latitude,
        float $longitude,
        string $title,
        string $address,
        string $foursquare_id = null,
        string $foursquare_type = null,
        string $google_place_id = null,
        string $google_place_type = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        array $reply_markup = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'title' => $title,
            'address' => $address
        ];

        if ($foursquare_id !== null) {
            $args['foursquare_id'] = $foursquare_id;
        }

        if ($foursquare_type !== null) {
            $args['foursquare_type'] = $foursquare_type;
        }

        if ($google_place_id !== null) {
            $args['google_place_id'] = $google_place_id;
        }

        if ($google_place_type !== null) {
            $args['google_place_type'] = $google_place_type;
        }

        if ($disable_notification !== null) {
            $args['disable_notification'] = $disable_notification;
        }

        if ($protect_content !== null) {
            $args['protect_content'] = $protect_content;
        }

        if ($reply_to_message_id !== null) {
            $args['reply_to_message_id'] = $reply_to_message_id;
        }

        if ($allow_sending_without_reply !== null) {
            $args['allow_sending_without_reply'] = $allow_sending_without_reply;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('sendVenue', $args);
    }

    public static function sendContact(
        $chat_id,
        string $phone_number,
        string $first_name,
        string $last_name = null,
        string $vcard = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        array $reply_markup = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'phone_number' => $phone_number,
            'first_name' => $first_name
        ];

        if ($last_name !== null) {
            $args['last_name'] = $last_name;
        }

        if ($vcard !== null) {
            $args['vcard'] = $vcard;
        }

        if ($disable_notification !== null) {
            $args['disable_notification'] = $disable_notification;
        }

        if ($protect_content !== null) {
            $args['protect_content'] = $protect_content;
        }

        if ($reply_to_message_id !== null) {
            $args['reply_to_message_id'] = $reply_to_message_id;
        }

        if ($allow_sending_without_reply !== null) {
            $args['allow_sending_without_reply'] = $allow_sending_without_reply;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('sendContact', $args);
    }

    public static function sendPoll(
        $chat_id,
        string $question,
        array $options,
        bool $is_anonymous = null,
        string $type = null,
        bool $allows_multiple_answers = null,
        int $correct_option_id = null,
        string $explanation = null,
        string $explanation_parse_mode = null,
        array $explanation_entities = null,
        int $open_period = null,
        int $close_date = null,
        bool $is_closed = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        array $reply_markup = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'question' => $question,
            'options' => json_encode($options)
        ];

        if ($is_anonymous !== null) {
            $args['is_anonymous'] = $is_anonymous;
        }

        if ($type !== null) {
            $args['type'] = $type;
        }

        if ($allows_multiple_answers !== null) {
            $args['allows_multiple_answers'] = $allows_multiple_answers;
        }

        if ($correct_option_id !== null) {
            $args['correct_option_id'] = $correct_option_id;
        }

        if ($explanation !== null) {
            $args['explanation'] = $explanation;
        }

        if ($explanation_parse_mode !== null) {
            $args['explanation_parse_mode'] = $explanation_parse_mode;
        }

        if ($explanation_entities !== null) {
            $args['explanation_entities'] = json_encode($explanation_entities);
        }

        if ($open_period !== null) {
            $args['open_period'] = $open_period;
        }

        if ($close_date !== null) {
            $args['close_date'] = $close_date;
        }

        if ($is_closed !== null) {
            $args['is_closed'] = $is_closed;
        }

        if ($disable_notification !== null) {
            $args['disable_notification'] = $disable_notification;
        }

        if ($protect_content !== null) {
            $args['protect_content'] = $protect_content;
        }

        if ($reply_to_message_id !== null) {
            $args['reply_to_message_id'] = $reply_to_message_id;
        }

        if ($allow_sending_without_reply !== null) {
            $args['allow_sending_without_reply'] = $allow_sending_without_reply;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('sendPoll', $args);
    }

    public static function sendDice(
        $chat_id,
        string $emoji = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        array $reply_markup = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id
        ];

        if ($emoji !== null) {
            $args['emoji'] = $emoji;
        }

        if ($disable_notification !== null) {
            $args['disable_notification'] = $disable_notification;
        }

        if ($protect_content !== null) {
            $args['protect_content'] = $protect_content;
        }

        if ($reply_to_message_id !== null) {
            $args['reply_to_message_id'] = $reply_to_message_id;
        }

        if ($allow_sending_without_reply !== null) {
            $args['allow_sending_without_reply'] = $allow_sending_without_reply;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('sendDice', $args);
    }

    public static function sendChatAction(
        $chat_id,
        string $action
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'action' => $action
        ];

        return Request::get('sendChatAction', $args);
    }

    public static function getUserProfilePhotos(
        int $user_id,
        int $offset = null,
        int $limit = null
    ): ?array
    {
        $args = [
            'user_id' => $user_id
        ];

        if ($offset !== null) {
            $args['offset'] = $offset;
        }

        if ($limit !== null) {
            $args['limit'] = $limit;
        }

        return Request::get('getUserProfilePhotos', $args);
    }

    public static function getFile(
        string $file_id
    ): ?array
    {
        $args = [
            'file_id' => $file_id
        ];

        return Request::get('getFile', $args);
    }

    public static function banChatMember(
        $chat_id,
        int $user_id,
        int $until_date = null,
        bool $revoke_messages = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'user_id' => $user_id
        ];

        if ($until_date !== null) {
            $args['until_date'] = $until_date;
        }

        if ($revoke_messages !== null) {
            $args['revoke_messages'] = $revoke_messages;
        }

        return Request::get('banChatMember', $args);
    }

    public static function unbanChatMember(
        $chat_id,
        int $user_id,
        bool $only_if_banned = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'user_id' => $user_id
        ];

        if ($only_if_banned !== null) {
            $args['only_if_banned'] = $only_if_banned;
        }

        return Request::get('unbanChatMember', $args);
    }

    public static function restrictChatMember(
        $chat_id,
        int $user_id,
        array $permissions,
        int $until_date = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
            'permissions' => json_encode($permissions)
        ];

        if ($until_date !== null) {
            $args['until_date'] = $until_date;
        }

        return Request::get('restrictChatMember', $args);
    }

    public static function promoteChatMember(
        $chat_id,
        int $user_id,
        bool $is_anonymous = null,
        bool $can_manage_chat = null,
        bool $can_post_messages = null,
        bool $can_edit_messages = null,
        bool $can_delete_messages = null,
        bool $can_manage_video_chats = null,
        bool $can_restrict_members = null,
        bool $can_promote_members = null,
        bool $can_change_info = null,
        bool $can_invite_users = null,
        bool $can_pin_messages = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'user_id' => $user_id
        ];

        if ($is_anonymous !== null) {
            $args['is_anonymous'] = $is_anonymous;
        }

        if ($can_manage_chat !== null) {
            $args['can_manage_chat'] = $can_manage_chat;
        }

        if ($can_post_messages !== null) {
            $args['can_post_messages'] = $can_post_messages;
        }

        if ($can_edit_messages !== null) {
            $args['can_edit_messages'] = $can_edit_messages;
        }

        if ($can_delete_messages !== null) {
            $args['can_delete_messages'] = $can_delete_messages;
        }

        if ($can_manage_video_chats !== null) {
            $args['can_manage_video_chats'] = $can_manage_video_chats;
        }

        if ($can_restrict_members !== null) {
            $args['can_restrict_members'] = $can_restrict_members;
        }

        if ($can_promote_members !== null) {
            $args['can_promote_members'] = $can_promote_members;
        }

        if ($can_change_info !== null) {
            $args['can_change_info'] = $can_change_info;
        }

        if ($can_invite_users !== null) {
            $args['can_invite_users'] = $can_invite_users;
        }

        if ($can_pin_messages !== null) {
            $args['can_pin_messages'] = $can_pin_messages;
        }

        return Request::get('promoteChatMember', $args);
    }

    public static function setChatAdministratorCustomTitle(
        $chat_id,
        int $user_id,
        string $custom_title
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
            'custom_title' => $custom_title
        ];

        return Request::get('setChatAdministratorCustomTitle', $args);
    }

    public static function banChatSenderChat(
        $chat_id,
        int $sender_chat_id
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'sender_chat_id' => $sender_chat_id
        ];

        return Request::get('banChatSenderChat', $args);
    }

    public static function unbanChatSenderChat(
        $chat_id,
        int $sender_chat_id
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'sender_chat_id' => $sender_chat_id
        ];

        return Request::get('unbanChatSenderChat', $args);
    }

    public static function setChatPermissions(
        $chat_id,
        array $permissions
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'permissions' => json_encode($permissions)
        ];

        return Request::get('setChatPermissions', $args);
    }

    public static function exportChatInviteLink(
        $chat_id
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id
        ];

        return Request::get('exportChatInviteLink', $args);
    }

    public static function createChatInviteLink(
        $chat_id,
        string $name = null,
        int $expire_date = null,
        int $member_limit = null,
        bool $creates_join_request = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id
        ];

        if ($name !== null) {
            $args['name'] = $name;
        }

        if ($expire_date !== null) {
            $args['expire_date'] = $expire_date;
        }

        if ($member_limit !== null) {
            $args['member_limit'] = $member_limit;
        }

        if ($creates_join_request !== null) {
            $args['creates_join_request'] = $creates_join_request;
        }

        return Request::get('createChatInviteLink', $args);
    }

    public static function editChatInviteLink(
        $chat_id,
        string $invite_link,
        string $name = null,
        int $expire_date = null,
        int $member_limit = null,
        bool $creates_join_request = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'invite_link' => $invite_link
        ];

        if ($name !== null) {
            $args['name'] = $name;
        }

        if ($expire_date !== null) {
            $args['expire_date'] = $expire_date;
        }

        if ($member_limit !== null) {
            $args['member_limit'] = $member_limit;
        }

        if ($creates_join_request !== null) {
            $args['creates_join_request'] = $creates_join_request;
        }

        return Request::get('editChatInviteLink', $args);
    }

    public static function revokeChatInviteLink(
        $chat_id,
        string $invite_link
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'invite_link' => $invite_link
        ];

        return Request::get('revokeChatInviteLink', $args);
    }

    public static function approveChatJoinRequest(
        $chat_id,
        int $user_id
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'user_id' => $user_id
        ];

        return Request::get('approveChatJoinRequest', $args);
    }

    public static function declineChatJoinRequest(
        $chat_id,
        int $user_id
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'user_id' => $user_id
        ];

        return Request::get('declineChatJoinRequest', $args);
    }

    public static function setChatPhoto(
        $chat_id,
        CURLFile $photo
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'photo' => $photo
        ];

        return Request::get('setChatPhoto', $args);
    }

    public static function deleteChatPhoto(
        $chat_id
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id
        ];

        return Request::get('deleteChatPhoto', $args);
    }

    public static function setChatTitle(
        $chat_id,
        string $title
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'title' => $title
        ];

        return Request::get('setChatTitle', $args);
    }

    public static function setChatDescription(
        $chat_id,
        string $description = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id
        ];

        if ($description !== null) {
            $args['description'] = $description;
        }

        return Request::get('setChatDescription', $args);
    }

    public static function pinChatMessage(
        $chat_id,
        int $message_id,
        bool $disable_notification = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'message_id' => $message_id
        ];

        if ($disable_notification !== null) {
            $args['disable_notification'] = $disable_notification;
        }

        return Request::get('pinChatMessage', $args);
    }

    public static function unpinChatMessage(
        $chat_id,
        int $message_id = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id
        ];

        if ($message_id !== null) {
            $args['message_id'] = $message_id;
        }

        return Request::get('unpinChatMessage', $args);
    }

    public static function unpinAllChatMessages(
        $chat_id
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id
        ];

        return Request::get('unpinAllChatMessages', $args);
    }

    public static function leaveChat(
        $chat_id
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id
        ];

        return Request::get('leaveChat', $args);
    }

    public static function getChat(
        $chat_id
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id
        ];

        return Request::get('getChat', $args);
    }

    public static function getChatAdministrators(
        $chat_id
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id
        ];

        return Request::get('getChatAdministrators', $args);
    }

    public static function getChatMemberCount(
        $chat_id
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id
        ];

        return Request::get('getChatMemberCount', $args);
    }

    public static function isFollower($chat_id, $user_id): int
    {
        $info = self::getChatMember($chat_id, $user_id);
        if ($info->ok == false || $info->result->status == "left") {
            return 0;
        } else {
            return 1;
        }
    }

    public static function getChatMember(
        $chat_id,
        int $user_id
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'user_id' => $user_id
        ];

        return Request::get('getChatMember', $args);
    }

    public static function setChatStickerSet(
        $chat_id,
        string $sticker_set_name
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'sticker_set_name' => $sticker_set_name
        ];

        return Request::get('setChatStickerSet', $args);
    }

    public static function deleteChatStickerSet(
        $chat_id
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id
        ];

        return Request::get('deleteChatStickerSet', $args);
    }

    public static function answerCallbackQuery(
        string $callback_query_id,
        string $text = null,
        bool   $show_alert = null,
        string $url = null,
        int    $cache_time = null
    ): ?array
    {
        $args = [
            'callback_query_id' => $callback_query_id
        ];

        if ($text !== null) {
            $args['text'] = $text;
        }

        if ($show_alert !== null) {
            $args['show_alert'] = $show_alert;
        }

        if ($url !== null) {
            $args['url'] = $url;
        }

        if ($cache_time !== null) {
            $args['cache_time'] = $cache_time;
        }

        return Request::get('answerCallbackQuery', $args);
    }

    public static function setMyCommands(
        array  $commands,
        array  $scope = null,
        string $language_code = null
    ): ?array
    {
        $args = [
            'commands' => json_encode($commands)
        ];

        if ($scope !== null) {
            $args['scope'] = json_encode($scope);
        }

        if ($language_code !== null) {
            $args['language_code'] = $language_code;
        }

        return Request::get('setMyCommands', $args);
    }

    public static function deleteMyCommands(
        array  $scope = null,
        string $language_code = null
    ): ?array
    {
        $args = [];

        if ($scope !== null) {
            $args['scope'] = json_encode($scope);
        }

        if ($language_code !== null) {
            $args['language_code'] = $language_code;
        }

        return Request::get('deleteMyCommands', $args);
    }

    public static function getMyCommands(
        array  $scope = null,
        string $language_code = null
    ): ?array
    {
        $args = [];

        if ($scope !== null) {
            $args['scope'] = json_encode($scope);
        }

        if ($language_code !== null) {
            $args['language_code'] = $language_code;
        }

        return Request::get('getMyCommands', $args);
    }

    public static function setChatMenuButton(
        int   $chat_id = null,
        array $menu_button = null
    ): ?array
    {
        $args = [];

        if ($chat_id !== null) {
            $args['chat_id'] = $chat_id;
        }

        if ($menu_button !== null) {
            $args['menu_button'] = json_encode($menu_button);
        }

        return Request::get('setChatMenuButton', $args);
    }

    public static function getChatMenuButton(
        int $chat_id = null
    ): ?array
    {
        $args = [];

        if ($chat_id !== null) {
            $args['chat_id'] = $chat_id;
        }

        return Request::get('getChatMenuButton', $args);
    }

    public static function setMyDefaultAdministratorRights(
        array $rights = null,
        bool  $for_channels = null
    ): ?array
    {
        $args = [];

        if ($rights !== null) {
            $args['rights'] = json_encode($rights);
        }

        if ($for_channels !== null) {
            $args['for_channels'] = $for_channels;
        }

        return Request::get('setMyDefaultAdministratorRights', $args);
    }

    public static function getMyDefaultAdministratorRights(
        bool $for_channels = null
    ): ?array
    {
        $args = [];

        if ($for_channels !== null) {
            $args['for_channels'] = $for_channels;
        }

        return Request::get('getMyDefaultAdministratorRights', $args);
    }

    public static function editMessageText(
        $chat_id = null,
        int $message_id = null,
        string $inline_message_id = null,
        string $text = null,
        string $parse_mode = null,
        array $entities = null,
        bool $disable_web_page_preview = null,
        array $reply_markup = null
    ): ?array
    {
        $args = [];

        if ($chat_id !== null) {
            $args['chat_id'] = $chat_id;
        }

        if ($message_id !== null) {
            $args['message_id'] = $message_id;
        }

        if ($inline_message_id !== null) {
            $args['inline_message_id'] = $inline_message_id;
        }

        if ($text !== null) {
            $args['text'] = $text;
        }

        if ($parse_mode !== null) {
            $args['parse_mode'] = $parse_mode;
        }

        if ($entities !== null) {
            $args['entities'] = json_encode($entities);
        }

        if ($disable_web_page_preview !== null) {
            $args['disable_web_page_preview'] = $disable_web_page_preview;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('editMessageText', $args);
    }

    public static function editMessageCaption(
        $chat_id = null,
        int $message_id = null,
        string $inline_message_id = null,
        string $caption = null,
        string $parse_mode = null,
        array $caption_entities = null,
        array $reply_markup = null
    ): ?array
    {
        $args = [];

        if ($chat_id !== null) {
            $args['chat_id'] = $chat_id;
        }

        if ($message_id !== null) {
            $args['message_id'] = $message_id;
        }

        if ($inline_message_id !== null) {
            $args['inline_message_id'] = $inline_message_id;
        }

        if ($caption !== null) {
            $args['caption'] = $caption;
        }

        if ($parse_mode !== null) {
            $args['parse_mode'] = $parse_mode;
        }

        if ($caption_entities !== null) {
            $args['caption_entities'] = json_encode($caption_entities);
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('editMessageCaption', $args);
    }

    public static function editMessageMedia(
        $chat_id = null,
        int $message_id = null,
        string $inline_message_id = null,
        array $media = null,
        array $reply_markup = null
    ): ?array
    {
        $args = [];

        if ($chat_id !== null) {
            $args['chat_id'] = $chat_id;
        }

        if ($message_id !== null) {
            $args['message_id'] = $message_id;
        }

        if ($inline_message_id !== null) {
            $args['inline_message_id'] = $inline_message_id;
        }

        if ($media !== null) {
            if (is_object($media['media'])) {
                $args['upload'] = $media['media'];
                $media['media'] = 'attach://upload';
            }
            $args['media'] = json_encode($media);
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('editMessageMedia', $args);
    }

    public static function editMessageReplyMarkup(
        $chat_id = null,
        int $message_id = null,
        string $inline_message_id = null,
        array $reply_markup = null
    ): ?array
    {
        $args = [];

        if ($chat_id !== null) {
            $args['chat_id'] = $chat_id;
        }

        if ($message_id !== null) {
            $args['message_id'] = $message_id;
        }

        if ($inline_message_id !== null) {
            $args['inline_message_id'] = $inline_message_id;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('editMessageReplyMarkup', $args);
    }

    public static function stopPoll(
        $chat_id,
        int $message_id,
        array $reply_markup = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'message_id' => $message_id
        ];

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('stopPoll', $args);
    }

    public static function deleteMessage(
        $chat_id,
        int $message_id
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'message_id' => $message_id
        ];

        return Request::get('deleteMessage', $args);
    }

    public static function sendSticker(
        $chat_id,
        $sticker,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        array $reply_markup = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'sticker' => $sticker
        ];

        if ($disable_notification !== null) {
            $args['disable_notification'] = $disable_notification;
        }

        if ($protect_content !== null) {
            $args['protect_content'] = $protect_content;
        }

        if ($reply_to_message_id !== null) {
            $args['reply_to_message_id'] = $reply_to_message_id;
        }

        if ($allow_sending_without_reply !== null) {
            $args['allow_sending_without_reply'] = $allow_sending_without_reply;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('sendSticker', $args);
    }

    public static function getStickerSet(
        string $name
    ): ?array
    {
        $args = [
            'name' => $name
        ];

        return Request::get('getStickerSet', $args);
    }

    public static function uploadStickerFile(
        int      $user_id,
        CURLFile $png_sticker
    ): ?array
    {
        $args = [
            'user_id' => $user_id,
            'png_sticker' => $png_sticker
        ];

        return Request::get('uploadStickerFile', $args);
    }

    public static function createNewStickerSet(
        int      $user_id,
        string   $name,
        string   $title,
                 $png_sticker = null,
        CURLFile $tgs_sticker = null,
        CURLFile $webm_sticker = null,
        string   $emojis = null,
        bool     $contains_masks = null,
        array    $mask_position = null
    ): ?array
    {
        $args = [
            'user_id' => $user_id,
            'name' => $name,
            'title' => $title
        ];

        if ($png_sticker !== null) {
            $args['png_sticker'] = $png_sticker;
        }

        if ($tgs_sticker !== null) {
            $args['tgs_sticker'] = $tgs_sticker;
        }

        if ($webm_sticker !== null) {
            $args['webm_sticker'] = $webm_sticker;
        }

        if ($emojis !== null) {
            $args['emojis'] = $emojis;
        }

        if ($contains_masks !== null) {
            $args['contains_masks'] = $contains_masks;
        }

        if ($mask_position !== null) {
            $args['mask_position'] = json_encode($mask_position);
        }

        return Request::get('createNewStickerSet', $args);
    }

    public static function addStickerToSet(
        int      $user_id,
        string   $name,
                 $png_sticker = null,
        CURLFile $tgs_sticker = null,
        CURLFile $webm_sticker = null,
        string   $emojis = null,
        array    $mask_position = null
    ): ?array
    {
        $args = [
            'user_id' => $user_id,
            'name' => $name
        ];

        if ($png_sticker !== null) {
            $args['png_sticker'] = $png_sticker;
        }

        if ($tgs_sticker !== null) {
            $args['tgs_sticker'] = $tgs_sticker;
        }

        if ($webm_sticker !== null) {
            $args['webm_sticker'] = $webm_sticker;
        }

        if ($emojis !== null) {
            $args['emojis'] = $emojis;
        }

        if ($mask_position !== null) {
            $args['mask_position'] = json_encode($mask_position);
        }

        return Request::get('addStickerToSet', $args);
    }

    public static function setStickerPositionInSet(
        string $sticker,
        int    $position
    ): ?array
    {
        $args = [
            'sticker' => $sticker,
            'position' => $position
        ];

        return Request::get('setStickerPositionInSet', $args);
    }

    public static function deleteStickerFromSet(
        string $sticker
    ): ?array
    {
        $args = [
            'sticker' => $sticker
        ];

        return Request::get('deleteStickerFromSet', $args);
    }

    public static function setStickerSetThumb(
        string $name,
        int    $user_id,
               $thumb = null
    ): ?array
    {
        $args = [
            'name' => $name,
            'user_id' => $user_id
        ];

        if ($thumb !== null) {
            $args['thumb'] = $thumb;
        }

        return Request::get('setStickerSetThumb', $args);
    }

    public static function answerInlineQuery(
        string $inline_query_id,
        array  $results,
        int    $cache_time = null,
        bool   $is_personal = null,
        string $next_offset = null,
        string $switch_pm_text = null,
        string $switch_pm_parameter = null
    ): ?array
    {
        $args = [
            'inline_query_id' => $inline_query_id,
            'results' => json_encode($results)
        ];

        if ($cache_time !== null) {
            $args['cache_time'] = $cache_time;
        }

        if ($is_personal !== null) {
            $args['is_personal'] = $is_personal;
        }

        if ($next_offset !== null) {
            $args['next_offset'] = $next_offset;
        }

        if ($switch_pm_text !== null) {
            $args['switch_pm_text'] = $switch_pm_text;
        }

        if ($switch_pm_parameter !== null) {
            $args['switch_pm_parameter'] = $switch_pm_parameter;
        }

        return Request::get('answerInlineQuery', $args);
    }

    public static function answerWebAppQuery(
        string $web_app_query_id,
        array  $result
    ): ?array
    {
        $args = [
            'web_app_query_id' => $web_app_query_id,
            'result' => json_encode($result)
        ];

        return Request::get('answerWebAppQuery', $args);
    }

    public static function sendInvoice(
        $chat_id,
        string $title,
        string $description,
        string $payload,
        string $provider_token,
        string $currency,
        array $prices,
        int $max_tip_amount = null,
        array $suggested_tip_amounts = null,
        string $start_parameter = null,
        string $provider_data = null,
        string $photo_url = null,
        int $photo_size = null,
        int $photo_width = null,
        int $photo_height = null,
        bool $need_name = null,
        bool $need_phone_number = null,
        bool $need_email = null,
        bool $need_shipping_address = null,
        bool $send_phone_number_to_provider = null,
        bool $send_email_to_provider = null,
        bool $is_flexible = null,
        bool $disable_notification = null,
        bool $protect_content = null,
        int $reply_to_message_id = null,
        bool $allow_sending_without_reply = null,
        array $reply_markup = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'title' => $title,
            'description' => $description,
            'payload' => $payload,
            'provider_token' => $provider_token,
            'currency' => $currency,
            'prices' => json_encode($prices)
        ];

        if ($max_tip_amount !== null) {
            $args['max_tip_amount'] = $max_tip_amount;
        }

        if ($suggested_tip_amounts !== null) {
            $args['suggested_tip_amounts'] = json_encode($suggested_tip_amounts);
        }

        if ($start_parameter !== null) {
            $args['start_parameter'] = $start_parameter;
        }

        if ($provider_data !== null) {
            $args['provider_data'] = $provider_data;
        }

        if ($photo_url !== null) {
            $args['photo_url'] = $photo_url;
        }

        if ($photo_size !== null) {
            $args['photo_size'] = $photo_size;
        }

        if ($photo_width !== null) {
            $args['photo_width'] = $photo_width;
        }

        if ($photo_height !== null) {
            $args['photo_height'] = $photo_height;
        }

        if ($need_name !== null) {
            $args['need_name'] = $need_name;
        }

        if ($need_phone_number !== null) {
            $args['need_phone_number'] = $need_phone_number;
        }

        if ($need_email !== null) {
            $args['need_email'] = $need_email;
        }

        if ($need_shipping_address !== null) {
            $args['need_shipping_address'] = $need_shipping_address;
        }

        if ($send_phone_number_to_provider !== null) {
            $args['send_phone_number_to_provider'] = $send_phone_number_to_provider;
        }

        if ($send_email_to_provider !== null) {
            $args['send_email_to_provider'] = $send_email_to_provider;
        }

        if ($is_flexible !== null) {
            $args['is_flexible'] = $is_flexible;
        }

        if ($disable_notification !== null) {
            $args['disable_notification'] = $disable_notification;
        }

        if ($protect_content !== null) {
            $args['protect_content'] = $protect_content;
        }

        if ($reply_to_message_id !== null) {
            $args['reply_to_message_id'] = $reply_to_message_id;
        }

        if ($allow_sending_without_reply !== null) {
            $args['allow_sending_without_reply'] = $allow_sending_without_reply;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('sendInvoice', $args);
    }

    public static function answerShippingQuery(
        string $shipping_query_id,
        bool   $ok,
        array  $shipping_options = null,
        string $error_message = null
    ): ?array
    {
        $args = [
            'shipping_query_id' => $shipping_query_id,
            'ok' => $ok
        ];

        if ($shipping_options !== null) {
            $args['shipping_options'] = json_encode($shipping_options);
        }

        if ($error_message !== null) {
            $args['error_message'] = $error_message;
        }

        return Request::get('answerShippingQuery', $args);
    }

    public static function answerPreCheckoutQuery(
        string $pre_checkout_query_id,
        bool   $ok,
        string $error_message = null
    ): ?array
    {
        $args = [
            'pre_checkout_query_id' => $pre_checkout_query_id,
            'ok' => $ok
        ];

        if ($error_message !== null) {
            $args['error_message'] = $error_message;
        }

        return Request::get('answerPreCheckoutQuery', $args);
    }

    public static function setPassportDataErrors(
        int   $user_id,
        array $errors
    ): ?array
    {
        $args = [
            'user_id' => $user_id,
            'errors' => json_encode($errors)
        ];

        return Request::get('setPassportDataErrors', $args);
    }

    public static function sendGame(
        int    $chat_id,
        string $game_short_name,
        bool   $disable_notification = null,
        bool   $protect_content = null,
        int    $reply_to_message_id = null,
        bool   $allow_sending_without_reply = null,
        array  $reply_markup = null
    ): ?array
    {
        $args = [
            'chat_id' => $chat_id,
            'game_short_name' => $game_short_name
        ];

        if ($disable_notification !== null) {
            $args['disable_notification'] = $disable_notification;
        }

        if ($protect_content !== null) {
            $args['protect_content'] = $protect_content;
        }

        if ($reply_to_message_id !== null) {
            $args['reply_to_message_id'] = $reply_to_message_id;
        }

        if ($allow_sending_without_reply !== null) {
            $args['allow_sending_without_reply'] = $allow_sending_without_reply;
        }

        if ($reply_markup !== null) {
            $args['reply_markup'] = json_encode($reply_markup);
        }

        return Request::get('sendGame', $args);
    }

    public static function setGameScore(
        int    $user_id,
        int    $score,
        bool   $force = null,
        bool   $disable_edit_message = null,
        int    $chat_id = null,
        int    $message_id = null,
        string $inline_message_id = null
    ): ?array
    {
        $args = [
            'user_id' => $user_id,
            'score' => $score
        ];

        if ($force !== null) {
            $args['force'] = $force;
        }

        if ($disable_edit_message !== null) {
            $args['disable_edit_message'] = $disable_edit_message;
        }

        if ($chat_id !== null) {
            $args['chat_id'] = $chat_id;
        }

        if ($message_id !== null) {
            $args['message_id'] = $message_id;
        }

        if ($inline_message_id !== null) {
            $args['inline_message_id'] = $inline_message_id;
        }

        return Request::get('setGameScore', $args);
    }

    public static function getGameHighScores(
        int    $user_id,
        int    $chat_id = null,
        int    $message_id = null,
        string $inline_message_id = null
    ): ?array
    {
        $args = [
            'user_id' => $user_id
        ];

        if ($chat_id !== null) {
            $args['chat_id'] = $chat_id;
        }

        if ($message_id !== null) {
            $args['message_id'] = $message_id;
        }

        if ($inline_message_id !== null) {
            $args['inline_message_id'] = $inline_message_id;
        }

        return Request::get('getGameHighScores', $args);
    }


}