<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\InviteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/not-authorized',[AuthController::class, 'notAuthorized'])->name('not_authorized');

Route::post('/send-code',[AuthController::class,'sendCodeToEmail']);

Route::post('/login',[AuthController::class,'loginStore']);

Route::middleware(['auth:api'])->group(function () {
    Route::post('/invite',[InviteController::class, 'invitation']);
});
