<?php

namespace App\Http\Requests\Issue;

class NotificationService 
{
    public const IOT_ALERT = 'ring';
    public const IOT_Duration = 1000; //misecond
    public const IOT_DEVICE_ENDPOINT = 'https://m4adtdev41.execute-api.us-east-1.amazonaws.com/dev/alert';

    public function notifyToIOTDevice($duration = NotificationService::IOT_Duration)
    {
    
        // https://m4adtdev41.execute-api.us-east-1.amazonaws.com/dev/alert?alert=ring&duration=1000
    }
}
