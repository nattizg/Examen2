<?php
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\DB;
use App\Models\Insumo;
use App\Models\Proveedor;
use App\Models\Empleado;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/dashboard', function () {
    return view('inicio.dashboard', [
        'totalInsumos'       => Insumo::count(),
        'proveedoresActivos' => Proveedor::where('estado', 'Activo')->count(),
        'totalEmpleados'     => Empleado::count(),
        'valorInventario'    => Insumo::sum(DB::raw('inventario * precio')),
    ]);
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
    Route::resource('recursoshumanos', EmpleadoController::class)
        ->parameters(['recursoshumanos' => 'empleado'])
        ->except('show');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // RUTAS PÚBLICAS (Solo invitados: guest) 
Route::middleware('guest')->group(function () { 
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login'); 
    Route::post('/login', [AuthController::class, 'login'])->name('login.post'); 
 
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register'); 
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});