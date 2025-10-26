<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TipoMembresiaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/clientes', ClienteController::class);
    Route::resource('/instructores', InstructorController::class)->parameters([
        'instructores' => 'instructor'
    ]);;
    
    Route::resource('/equipos', EquipoController::class);
    Route::resource('/productos', ProductoController::class);

    Route::get('/tipomembresia', [TipoMembresiaController::class, 'index'])->name('tipomembresia.index');
    Route::post('/tipomembresia', [TipoMembresiaController::class, 'store'])->name('tipomembresia.store');
    Route::get('/tipomembresia/create', [TipoMembresiaController::class, 'create'])->name('tipomembresia.create');
    Route::get('/tipomembresia/{tipomembresia}', [TipoMembresiaController::class, 'show'])->name('tipomembresia.show');
    Route::put('/tipomembresia', [TipoMembresiaController::class, 'update'])->name('tipomembresia.update');
    Route::delete('/tipomembresia/{tipomembresia}', [TipoMembresiaController::class, 'destroy'])->name('tipomembresia.destroy');
    Route::get('/tipomembresia/{tipomembresia}/edit', [TipoMembresiaController::class, 'edit'])->name('tipomembresia.edit');
});

Route::get('/123', function () {
    return "s";
});

Route::get('/home', function () {
    return "esta es la home";
});

Route::get('/123', function () {
    return view('welcome');
});




require __DIR__ . '/auth.php';
