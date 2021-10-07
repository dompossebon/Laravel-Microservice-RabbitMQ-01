<?php

use App\Http\Controllers\Api\{
    CategoryController,
    CompanyController
};
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

/**
 *
 */
//Route::resource(
//    [
//        'categories', CategoryController::class,
//        'companies', CompanyController::class,
//    ]
//);

Route::resource('categories', CategoryController::class);
Route::resource('companies', CompanyController::class);

Route::get('/', function () {
    return response()->json(['message' => 'success']);
});

Route::fallback(function () {
    return response()->json(['error' => 'Route not found.'], 404);
});
