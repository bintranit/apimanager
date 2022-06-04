<?php

use App\Modules\Lop\Controllers\CompanyController;
use App\Modules\Thanhvien\Controllers\ThanhvienController;
use App\Modules\Employee\Repositories\EmployeeRepository;
use App\Modules\Employee\Services\EmployeeService;
use App\Modules\Lophoc\Controllers\LophocController;
use App\Modules\User\Controllers\UserController;
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

Route::prefix('v1')->group(function (){
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']); 

    Route::middleware('auth:api')->group(function () {
        Route::prefix('user')->group(function (){
            Route::get('/', [UserController::class, 'getCurrentUser']);
            Route::put('/', [UserController::class, 'update']);      
        });

        Route::prefix('lophoc')->group(function (){  
            Route::post('/create', [LophocController::class, 'create']);
            Route::get('/', [LophocController::class, 'getAll']);
            Route::get('/{id}', [LophocController::class, 'getById']);
            Route::put('/{id}', [LophocController::class, 'updateById']);
            Route::delete('/{id}', [LophocController::class, 'deleteById']);           
        });

        Route::prefix('thanhvien')->group(function() {
            Route::post('/create', [ThanhvienController::class, 'create']);
            Route::get('/', [ThanhvienController::class, 'getAll']);
            Route::get('/{id}', [ThanhvienController::class, 'getById']);
            Route::put('/{id}', [ThanhvienController::class, 'updateById']);
            Route::delete('/{id}', [ThanhvienController::class, 'deleteById']);
            Route::get('/lop/{lop_id}', [ThanhvienController::class, 'getThanhvienCuaLophop']);
        });
        

    });
});

