<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;

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

/*================================Categories================================*/
/* Show All Categories */
Route::get('Categories', [CategorieController::class, 'index']);

/* Show One Categorie */
Route::get('Categorie/{id}', [CategorieController::class, 'show']);

/* Add A Categorie */
Route::post('Categorie', [CategorieController::class, 'store']);

/* Update A Categorie */
Route::put('Categorie/{id}', [CategorieController::class, 'update']);

/* Delete A Categorie */
Route::delete('Categorie/{id}', [CategorieController::class, 'destroy']);
    /*================================End Categories================================*/