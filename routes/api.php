<?php

use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => 'v1'], function (){
    Route::post('/login', [LoginController::class, 'login']);
});

Route::group(['prefix' => 'v1', 'middleware' => 'api-auth:api'], function () {
    Route::post('/logout', [LoginController::class, 'logout']);

    Route::post('/transaction-store', [TransactionController::class, 'store']);
    Route::post('/search-transaction', [TransactionController::class, 'searchTransaction']);
});
