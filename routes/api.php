<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\TvshowController;
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

// Exposed endpoints
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Authenticated endpoints
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/refresh', [AuthController::class, 'refresh']);
    Route::get('/logout', [AuthController::class, 'logout']);
    // Movies
    Route::get('/movies', [MovieController::class, 'index']);
    Route::get('/movies/{movie}', [MovieController::class, 'show']);
    Route::post('/movies', [MovieController::class, 'store']);
    Route::post('/movies/actor', [MovieController::class, 'attach']);
    Route::post('/movies/filter', [MovieController::class, 'filter']);
    Route::get('/movies/search/{q}', [MovieController::class, 'search']);
    // TV Shows
    Route::get('/tvshows', [TvshowController::class, 'index']);
    Route::get('/tvshows/{tvshow}', [TvshowController::class, 'show']);
    Route::post('/tvshows', [TvshowController::class, 'store']);
    Route::post('/tvshows/filter', [TvshowController::class, 'filter']);
    Route::get('/tvshows/search/{q}', [TvshowController::class, 'search']);
    // Seasons
    Route::get('/seasons/{season}', [SeasonController::class, 'show']);
    Route::post('/seasons', [SeasonController::class, 'store']);
    // Episodes
    Route::get('/episodes', [EpisodeController::class, 'index']);
    Route::get('/episodes/{episode}', [EpisodeController::class, 'show']);
    Route::post('/episodes', [EpisodeController::class, 'store']);
    // Actors
    Route::get('/actors', [ActorController::class, 'index']);
    Route::get('/actors/{actor}', [ActorController::class, 'show']);
    Route::post('/actors', [ActorController::class, 'store']);
    // Directors
    Route::get('/directors', [DirectorController::class, 'index']);
    Route::get('/directors/{director}', [DirectorController::class, 'show']);
    Route::post('/directors', [DirectorController::class, 'store']);
});
