<?php

use App\Http\Controllers\Api\PublicationsController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/users', function () {
    if (rand(1, 10) < 3) {
        abort(500, 'We could not retrieve the users');
    }

    return \App\Models\User::factory()->count(10)->create();
});


Route::namespace('Api')->group(function () {
    Route::get('/publications', [PublicationsController::class, 'list']);
    Route::get('/publications/{publication}', [PublicationsController::class, 'show']);
    Route::put('/publications/{publication}', [PublicationsController::class, 'update']);
    Route::delete('/publications/{publication}', [PublicationsController::class, 'destroy']);
    Route::post('/publications', [PublicationsController::class, 'store']);


});
