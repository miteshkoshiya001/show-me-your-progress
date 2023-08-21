<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\StickerApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get-drivers', [DriverController::class, 'index']);
Route::get('driver/{driverId}/stickers', [StickerApiController::class,'getStickersByDriver']);
Route::post('/feedback', [FeedbackController::class, 'submitFeedback']);
