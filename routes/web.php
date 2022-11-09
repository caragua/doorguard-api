<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardReaderController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AccessRuleController;
use App\Http\Controllers\ScanReportController;
use App\Http\Controllers\AttendeeController;

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

    Route::get(     'sites',            [SiteController::class, 'index'     ]);
    Route::get(     'sites/options',    [SiteController::class, 'options'   ]);
    Route::get(     'sites/{siteId}',   [SiteController::class, 'show'      ]);
    Route::post(    'sites',            [SiteController::class, 'store'     ]);
    Route::put(     'sites/{siteId}',   [SiteController::class, 'update'    ]);
    Route::delete(  'sites/{siteId}',   [SiteController::class, 'destroy'   ]);

    Route::get(     'cardReaders',                  [CardReaderController::class, 'index'   ]);
    Route::get(     'cardReaders/options',          [CardReaderController::class, 'options' ]);
    Route::get(     'cardReaders/{cardReaderId}',   [CardReaderController::class, 'show'    ]);
    Route::post(    'cardReaders',                  [CardReaderController::class, 'store'   ]);
    Route::put(     'cardReaders/{cardReaderId}',   [CardReaderController::class, 'update'  ]);
    Route::delete(  'cardReaders/{cardReaderId}',   [CardReaderController::class, 'destroy' ]);

    Route::get(     'accessRules',                  [AccessRuleController::class, 'index'   ]);
    Route::get(     'accessRules/options',          [AccessRuleController::class, 'options' ]);
    Route::get(     'accessRules/{accessRuleId}',   [AccessRuleController::class, 'show'    ]);
    Route::post(    'accessRules',                  [AccessRuleController::class, 'store'   ]);
    Route::put(     'accessRules/{accessRuleId}',   [AccessRuleController::class, 'update'  ]);
    Route::delete(  'accessRules/{accessRuleId}',   [AccessRuleController::class, 'destroy' ]);

    Route::get(     'attendees',                [AttendeeController::class, 'index'   ]);
    Route::get(     'attendees/options',        [AttendeeController::class, 'options' ]);
    Route::get(     'attendees/{attendeeId}',   [AttendeeController::class, 'show'    ]);
    Route::post(    'attendees',                [AttendeeController::class, 'store'   ]);
    Route::put(     'attendees/{attendeeId}',   [AttendeeController::class, 'update'  ]);
    Route::delete(  'attendees/{attendeeId}',   [AttendeeController::class, 'destroy' ]);
    
});