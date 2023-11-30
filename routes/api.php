<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Http\Middleware\EnsureTokenIsValid; // Asegúrate de importar el middleware adecuado
use App\Http\Controllers\Auth\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware([EnsureTokenIsValid::class])->group(function () {
    Route::get('/tareas/{idUsuario}', [TareaController::class, 'listarTareas']);
    Route::post('/agregar-tarea', [TareaController::class, 'agregarTarea']);
    Route::put('/editar-tarea/{tarea}', [TareaController::class, 'editarTarea']);
    Route::delete('/eliminar-tarea/{tarea}', [TareaController::class, 'eliminarTarea']);
    Route::put('/cambiar-estado-tarea/{tarea}', [TareaController::class, 'cambiarEstadoTarea']);
});