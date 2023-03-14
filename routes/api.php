<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanteController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\Api\AuthenticationController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [AuthenticationController::class, 'login']);

Route::post('register', [AuthenticationController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('logout', [AuthenticationController::class, 'logout']);

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

    /*================================Plantes================================*/
    /* Show All Plantes */
    Route::get('Plantes', [PlanteController::class, 'index']);

    /* Show One Plante */
    Route::get('Plante/{id}', [PlanteController::class, 'show']);

    /* Add A Plante */
    Route::post('Plante', [PlanteController::class, 'store']);

    /* Update A Plante */
    Route::put('Plante/{id}', [PlanteController::class, 'update']);

    /* Delete A Plante */
    Route::delete('Plante/{id}', [PlanteController::class, 'destroy']);
    /*================================End Plantes================================*/
});
