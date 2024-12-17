<?php

use App\Http\Controllers\API\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthenticationController::class, 'login']);

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
