<?php

use App\Http\Controllers\Backend\AdminController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    // Verifica si el usuario no está autenticado
    if (!auth()->check()) {
        // Redirige al login si el usuario no está autenticado
        return Redirect::action([AdminController::class,'login']);
    }

    // El usuario está autenticado, redirige al área de administración
    return Redirect::action([AdminController::class,'home']); // Ajusta según tus rutas
});

Route::prefix('admin')->group(function () {

    Route::middleware('admin-logueado:0')->group(function () {
        Route::get('login', [AdminController::class, 'login']);  // Ruta para mostrar el formulario de inicio de sesión
        Route::get('vista_registrar', [AdminController::class, 'vista_registrar']);  // Ruta para mostrar el formulario de inicio de sesión
        Route::post('registro', [AdminController::class, 'registro']);  // Ruta para procesar el inicio de sesión (POST)
        Route::post('login', [AdminController::class, 'loguear']);  // Ruta para procesar el inicio de sesión (POST)
    });
});
