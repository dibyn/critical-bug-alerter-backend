<?php

namespace App\Http\Controllers\Bug;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Symfony\Component\HttpFoundation\Response;

class BugController extends Controller
{
    public function test(Request $request) {
        die('in bug controller');
    }
}
