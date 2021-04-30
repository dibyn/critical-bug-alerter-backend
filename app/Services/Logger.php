<?php


namespace App\Services;


use App\Models\Issue;
use Illuminate\Support\Facades\Http;

class Logger
{
    static public function __callStatic($method, $request) {
        $issue = new Issue();
        $issue->name = $request[0];
        $issue->level = $method;
        $issue->description = $request[1];
        $issue->save();
        if($method == "fatal") {
            NotificationService::notify();
        }
    }
}