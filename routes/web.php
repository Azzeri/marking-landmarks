<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LandmarkUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    echo ('Oznaczanie miejsc');
});

Route::get('/landmark/{lat}/{lng}', [LandmarkUserController::class, 'getLandmarkData']);
Route::post('/landmark/updateProperty', [LandmarkUserController::class, 'updateProperty']);
Route::get('/getAllLandmarks', [LandmarkUserController::class, 'getAllLandmarks']);
Route::get('/getAllLandmarksForUser/{id_user}', [LandmarkUserController::class, 'getAllLandmarksForUser']);

Route::get('/getCommentsForLandmark/{landmarkId}', [CommentController::class, 'getCommentsForLandmark']);
Route::post('/landmark/addComment', [CommentController::class, 'addComment']);
