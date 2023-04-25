<?php

use App\Http\Controllers\DocumentController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/', function (Request $request) {
//     return "tes";
// });
Route::get('document/all/favorite', [DocumentController::class, 'getFavorites']);
Route::apiResource('/document', DocumentController::class);
Route::get('document/{id}/download', [DocumentController::class, 'download']);
Route::post('document/{id}/favorite', [DocumentController::class, 'toggleFavorite']);
