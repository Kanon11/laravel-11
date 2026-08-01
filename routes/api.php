<?php

use App\Http\Middleware\RouteCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/health', function (Request $request) {
     Log::info('3', ['route' => $request->route()?->getName(), 'path' => $request->path()]);
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toIso8601String(),
    ]);
})->name('api.health')->middleware(RouteCheck::class);
