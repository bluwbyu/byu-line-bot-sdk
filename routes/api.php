<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WebhookController;
use App\Http\Controllers\Api\PostController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('/webhook', [WebhookController::class,'getMessage']);
Route::post('/webhook', [WebhookController::class,'webhook']);

Route::get('login', function () {
    return view('login');
});

Route::post('/post', [PostController::class,'store']);
//Route::apiResource('/webhook', \App\Http\Controllers\Api\WebhookController::class);
