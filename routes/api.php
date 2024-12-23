<?php

use App\Http\Controllers\API\AuthenticationController;
use App\ResponseFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;

// Route::apiResource('products', ProductController::class); untuk testing route list pada ProductController

Route::get('/user', function (Request $request) {
    return ResponseFormatter::success($request->user());
})->middleware('auth:sanctum');

Route::post('/login', [AuthenticationController::class, 'login']);

Route::prefix('product')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
    Route::post('/', [ProductController::class, 'store']);
    Route::patch('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
});

// Route::get('/welcome', function (Request $request) {
//     return response()->json([
//         'name' => "Fikri"
//     ]); // return 'fikri';
// });

// Route::post('/welcome', function (Request $request) {
//     return $request->all(); //untuk return semua key dan value yang ada di body 
//     // return $request->header('Authorization'); untuk return header
//     // return $request->nama; untuk return berdasarkan key
// });
