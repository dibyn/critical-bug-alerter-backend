<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bug\BugController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/issue/list', [BugController::class, 'list']);
Route::get('/issue/status', [BugController::class, 'listIssueStatus']);
Route::get('/generate/issue', [BugController::class, 'generateIssue']);
Route::Post('/create/issue', [BugController::class, 'createIssue']);
Route::Post('/issue/change-status/{id}', [BugController::class, 'changeStatus']);
