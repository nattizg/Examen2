<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/dashboard', function () {
    return view('layouts.app');
})->middleware('auth')->name('dashboard');

Route::get('insumos', function () {
    return view('insumos.index');
})->name('insumos');

Route::get('proveedores', function () {
    return view('proveedores.index');
})->name('proveedores');


// Si manejas el cierre de sesión mediante un controlador:
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // RUTAS PÚBLICAS (Solo invitados: guest) 
Route::middleware('guest')->group(function () { 
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login'); 
    Route::post('/login', [AuthController::class, 'login'])->name('login.post'); 
 
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register'); 
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});