<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->prefix('teknisi')->group(function () {
    Route::get('/', [TeknisiController::class, 'index']);
    Route::get('/{teknisi}', [TeknisiController::class, 'show']);
    Route::put('/{teknisi}/status', [TeknisiController::class, 'updateStatus']);
});
