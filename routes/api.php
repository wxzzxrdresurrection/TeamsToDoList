<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/recover-password', [AuthController::class, 'recoverPassword']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::delete('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'profile']);
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'findAll']);
        Route::get('/{id}', [UserController::class, 'findOne']);
        Route::post('/search', [UserController::class, 'searchForUser']);
        Route::put('/update-password', [UserController::class, 'updatePassword']);
    });

    Route::prefix('teams')->group(function () {
        Route::get('/', [TeamController::class, 'findTeamsByUser']);
        Route::get('/{id}', [TeamController::class, 'findOne']);
        Route::get('/users/{id}', [TeamController::class, 'getUsersByTeam']);
        Route::post('/create', [TeamController::class, 'create']);
        Route::put('/{id}', [TeamController::class, 'update']);
        Route::post('/join', [TeamController::class, 'joinTeamByCode']);
        Route::post('/add-user/{id}', [TeamController::class, 'addUserToTeam']);
        Route::delete('/remove-user/{teamId}/{userId}', [TeamController::class, 'removeUserFromTeam']);
    });

    Route::prefix('tasks')->group(function () {
        Route::get('/team/{status}/{id}', [TaskController::class, 'findTasksByTeam']);
        Route::get('/user/{status}/{teamId}/{userId}', [TaskController::class, 'findTasksByUserAndTeam']);
        Route::get('/{id}', [TaskController::class, 'findOne']);
        Route::get('/{teamId}/user', [TaskController::class, 'getMyTasks']);
        Route::post('/create', [TaskController::class, 'create']);
        Route::put('/{id}', [TaskController::class, 'update']);
        Route::post('/assign/{id}', [TaskController::class, 'addTaskToUser']);
        Route::put('/complete/{id}', [TaskController::class, 'markTaskAsCompleted']);
        Route::put('/pending/{id}', [TaskController::class, 'unmarkTaskAsCompleted']);
        Route::delete('/{id}', [TaskController::class, 'delete']);
    });
});
