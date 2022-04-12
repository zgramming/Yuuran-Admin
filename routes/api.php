<?php

use App\Http\Controllers\Api\V1\AuthenticationApiController;
use App\Http\Controllers\Api\V1\CitizenApiController;
use App\Http\Controllers\Api\V1\DuesApiController;
use App\Http\Controllers\DuesCategoryApiController;
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

Route::post("/v1/login", [AuthenticationApiController::class, "login"]);
Route::post("/v1/logout", [AuthenticationApiController::class, "logout"]);

Route::get("/v1/dues/statistics", [DuesApiController::class, 'statistics']);
Route::get("/v1/dues/recent-activity", [DuesApiController::class, 'recentActivity']);
Route::get("/v1/dues/calendar", [DuesApiController::class, 'calendar']);
Route::get("/v1/dues/calendar/detail", [DuesApiController::class, 'calendarDetail']);
Route::get("/v1/dues/citizen/{username}", [DuesApiController::class, 'duesByUsername']);
Route::get("/v1/dues/{dues_detail_id}",[DuesApiController::class,'get']);
Route::post("/v1/dues/save/{dues_detail_id}", [DuesApiController::class, 'save']);

Route::get("/v1/duesCategory", [DuesCategoryApiController::class, 'get']);
Route::get("/v1/duesCategory/{dues_category_id}", [DuesCategoryApiController::class, 'get']);
Route::post("/v1/duesCategory/save/{dues_category_id}", [DuesCategoryApiController::class, 'save']);

Route::get("/v1/citizen", [CitizenApiController::class, 'get']);
Route::get("/v1/citizen/{users_id}", [CitizenApiController::class, 'get']);
Route::post("/v1/citizen/save/{user_id}",[CitizenApiController::class,'save']);

Route::group(['middleware' => ['auth:sanctum']], function () {
});
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});



