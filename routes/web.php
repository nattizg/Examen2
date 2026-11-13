<?php
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProveedorController;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/dashboard', function () {
    return view('layouts.app');
})->middleware('auth')->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('insumos', InsumoController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('proveedores', ProveedorController::class)->parameters([
    'proveedores' => 'proveedor'
    ]);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('recursoshumanos', EmpleadoController::class);
});


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // RUTAS PÚBLICAS (Solo invitados: guest) 
Route::middleware('guest')->group(function () { 
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login'); 
    Route::post('/login', [AuthController::class, 'login'])->name('login.post'); 
 
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register'); 
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});