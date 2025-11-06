<?php

use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\MembresiaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TipoMembresiaController;
use App\Http\Controllers\UsuarioController;
use App\Models\Mantenimiento;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::get('/clientes/pdf', [ClienteController::class, 'pdf'])->name('clientes.pdf');
    
    Route::get('/instructores/pdf', [InstructorController::class, 'pdf'])->name('instructores.pdf');
    Route::resource('/instructores', InstructorController::class)->parameters([
        'instructores' => 'instructor'
    ]);;

    Route::get('/equipos/pdf', [EquipoController::class, 'pdf'])->name('equipos.pdf');
    Route::resource('/equipos', EquipoController::class);
    Route::post('/equipos/{equipo}/mantenimiento', [EquipoController::class, 'mantenimientoStore'])->name('equipos.mantenimiento.store');

    Route::get('/tipomembresia', [TipoMembresiaController::class, 'index'])->name('tipomembresia.index');
    Route::post('/tipomembresia', [TipoMembresiaController::class, 'store'])->name('tipomembresia.store');
    Route::get('/tipomembresia/create', [TipoMembresiaController::class, 'create'])->name('tipomembresia.create');
    Route::get('/tipomembresia/{tipomembresia}', [TipoMembresiaController::class, 'show'])->name('tipomembresia.show');
    Route::put('/tipomembresia', [TipoMembresiaController::class, 'update'])->name('tipomembresia.update');
    Route::delete('/tipomembresia/{tipomembresia}', [TipoMembresiaController::class, 'destroy'])->name('tipomembresia.destroy');
    Route::get('/tipomembresia/{tipomembresia}/edit', [TipoMembresiaController::class, 'edit'])->name('tipomembresia.edit');
    
    Route::get('/productos/pdf', [ProductoController::class, 'pdf'])->name('productos.pdf');
    Route::resource('/mantenimientos', Mantenimiento::class);
    Route::resource('/usuarios', UsuarioController::class);
});


Route::middleware(['auth', 'role:administrador,recepcionista'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/clientes', ClienteController::class);
    Route::resource('/productos', ProductoController::class);
    Route::resource('/asistencias', AsistenciaController::class);
    Route::resource('/membresias', MembresiaController::class);
    Route::post('/pagos', [PagoController::class, 'store'])->name('pagos.store');
});

Route::get('/123', function () {
    return "s";
});

Route::get('/home', function () {
    return view('home');
});

require __DIR__ . '/auth.php';
