<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\AtencionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::get('/todosClientes', [ClienteController::class, 'todosClientes']);
Route::post('/agregarCliente', [ClienteController::class, 'agregarCliente']);
Route::get('/citas/activas', [CitaController::class, 'obtenerCitasActivas']);
Route::post('/citas', [CitaController::class, 'crearCita']);
Route::get('/atenciones', [AtencionController::class, 'index']);
Route::post('/atenciones', [AtencionController::class, 'store']);