<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardReaderController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AccessRuleController;
use App\Http\Controllers\ScanReportController;

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


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('logout', [AuthController::class, 'logout']);

    Route::get('sites', [SiteController::class, 'index']);
    Route::get('sites/codes', [SiteController::class, 'showCodes']);
    Route::get('sites/{siteId}', [SiteController::class, 'show']);
    Route::post('sites', [SiteController::class, 'store']);
    Route::put('sites/{siteId}', [SiteController::class, 'update']);
    Route::delete('sites/{siteId}', [SiteController::class, 'destroy']);
    
});