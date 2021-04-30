<?php


namespace App\Http\Controllers;


use App\Services\Logger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClientAppController extends Controller
{
    public function register(Request $request)
    {
        Logger::info('PHP Parse error: syntax error, unexpected end of file', json_encode($request->all()));
        return view('welcome', ['success' => 'Thank you for signing up. ']);
    }

    public function error(Request $request)
    {
        Logger::fatal('Database down', "Couldn't connect to remote database.");
        return view('welcome', ['error' => 'Error signing up. ']);
    }
}