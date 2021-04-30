<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NotificationService
{
    public const IOT_ALERT = 'ring';
    public const RING_DURATION = 5000; //milli seconds
    public const NOTIFY_AFTER = 20000;
    public const IOT_DEVICE_ENDPOINT = 'https://m4adtdev41.execute-api.us-east-1.amazonaws.com/dev/alert';

    public static function notify($duration = self::RING_DURATION, $ringAfter = self::NOTIFY_AFTER)
    {
        $payload = [
            'alert' => self::IOT_ALERT,
            'duration' => $duration,
            'ringAfter' => $ringAfter,
        ];
        return Http::get(self::IOT_DEVICE_ENDPOINT . '?' . http_build_query($payload));
    }

    public static function stopNotification()
    {
        return Http::get(self::IOT_DEVICE_ENDPOINT . '?' . http_build_query(['alert' => 'stop']));
    }
}
