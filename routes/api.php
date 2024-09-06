<?php

use App\Http\Controllers\Api\RegionController;
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
Route::get('states', [RegionController::class, 'states']);
Route::get('cities/{state_code}', [RegionController::class, 'cities']);
Route::get('sectors/{city_code}', [RegionController::class, 'sectors']);
Route::get('villages/{sector_code}', [RegionController::class, 'villages']);
