<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\UsersController;
use App\Http\Controllers\V1\RolesController;
use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\MenusController;
use App\Http\Controllers\V1\MasterMenusController;
use App\Http\Controllers\V1\PermissionAccessController;
use App\Http\Controllers\V1\PermissionsController;
use App\Http\Controllers\V1\EspresencesController;
use App\Http\Controllers\InitController;


Route::get('/kamekameha', [InitController::class, 'init']);

Route::group(['prefix' => 'v1', 'namespace' => 'V1'], function () {
    Route::group(['prefix' => '{language}'], function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);

        Route::group(['middleware' => 'auth:sanctum'], function () {
            Route::get('/me', [AuthController::class, 'profile']);
            Route::get('/auth', [AuthController::class, 'check']);
            Route::post('/logout', [AuthController::class, 'logout']);

            Route::group(['prefix' => 'users'], function () {
                Route::get('/', [UsersController::class, 'index']);
                Route::get('/{id}', [UsersController::class, 'show']);
                Route::post('/', [UsersController::class, 'store']);
                Route::put('/{id}', [UsersController::class, 'update']);
                Route::delete('/{id}', [UsersController::class, 'destroy']);
                Route::delete('/force/{id}', [UsersController::class, 'force']);
                Route::put('/restore/{id}', [UsersController::class, 'restore']);
            });
            Route::group(['prefix' => 'roles'], function () {
                Route::get('/', [RolesController::class, 'index']);
                Route::get('/{id}', [RolesController::class, 'show']);
                Route::post('/', [RolesController::class, 'store']);
                Route::put('/{id}', [RolesController::class, 'update']);
                Route::delete('/{id}', [RolesController::class, 'destroy']);
                Route::delete('/force/{id}', [RolesController::class, 'force']);
                Route::put('/restore/{id}', [RolesController::class, 'restore']);
            });
            Route::group(['prefix' => 'master-menus'], function () {
                Route::get('/', [MasterMenusController::class, 'index']);
                Route::get('/{id}', [MasterMenusController::class, 'show']);
                Route::post('/', [MasterMenusController::class, 'store']);
                Route::put('/{id}', [MasterMenusController::class, 'update']);
                Route::delete('/{id}', [MasterMenusController::class, 'destroy']);
                Route::delete('/force/{id}', [MasterMenusController::class, 'force']);
                Route::put('/restore/{id}', [MasterMenusController::class, 'restore']);
            });
            Route::group(['prefix' => 'menus'], function () {
                Route::get('/', [MenusController::class, 'index']);
                Route::get('/{id}', [MenusController::class, 'show']);
                Route::post('/', [MenusController::class, 'store']);
                Route::put('/{id}', [MenusController::class, 'update']);
                Route::delete('/{id}', [MenusController::class, 'destroy']);
                Route::delete('/force/{id}', [MenusController::class, 'force']);
                Route::put('/restore/{id}', [MenusController::class, 'restore']);
            });
            Route::group(['prefix' => 'permissions'], function () {
                Route::get('/', [PermissionsController::class, 'index']);
                Route::get('/{id}', [PermissionsController::class, 'show']);
                Route::post('/', [PermissionsController::class, 'store']);
                Route::put('/{id}', [PermissionsController::class, 'update']);
                Route::delete('/{id}', [PermissionsController::class, 'destroy']);
                Route::delete('/force/{id}', [PermissionsController::class, 'force']);
                Route::put('/restore/{id}', [PermissionsController::class, 'restore']);
            });
            Route::group(['prefix' => 'permission-access'], function () {
                Route::get('/', [PermissionAccessController::class, 'index']);
                Route::get('/{id}', [PermissionAccessController::class, 'show']);
                Route::post('/', [PermissionAccessController::class, 'store']);
                Route::put('/{id}', [PermissionAccessController::class, 'update']);
                Route::delete('/{id}', [PermissionAccessController::class, 'destroy']);
                Route::delete('/force/{id}', [PermissionAccessController::class, 'force']);
                Route::put('/restore/{id}', [PermissionAccessController::class, 'restore']);
            });
            Route::group(['prefix' => 'espresences'], function () {
                Route::get('/', [EspresencesController::class, 'index']);
                Route::get('/{id}', [EspresencesController::class, 'show']);
                Route::post('/', [EspresencesController::class, 'store']);
                Route::put('/{id}', [EspresencesController::class, 'update']);
                Route::delete('/{id}', [EspresencesController::class, 'destroy']);
                Route::delete('/force/{id}', [EspresencesController::class, 'force']);
                Route::put('/restore/{id}', [EspresencesController::class, 'restore']);
            });
        });
    });
});
