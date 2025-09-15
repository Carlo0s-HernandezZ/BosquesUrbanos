<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ParquesViewController;

// Rutas web 
Route::get('/', function () {
    return Inertia::render('welcome'); 
})->name('home');

Route::middleware(['verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

//Rutas base
Route::get('/parques', [ParquesViewController::class, 'index'])->name('parques.index');
Route::get('/parques/buscar', [ParquesViewController::class, 'buscar'])->name('parques.buscar');
Route::get('/parques/{id}',    [ParquesViewController::class, 'show'])->name('parques.show');

//Rutas CRUD
Route::get('/parques/{id}/editar', [ParquesViewController::class, 'edit'])->whereNumber('id')->name('parques.edit');
Route::put('/parques/{id}', [ParquesViewController::class, 'update'])->whereNumber('id')->name('parques.update');
Route::delete('/parques/{id}', [ParquesViewController::class, 'destroy'])->whereNumber('id')->name('parques.destroy');
Route::get('/crear', [ParquesViewController::class, 'create'])->name('parques.create');
Route::post('/parques', [ParquesViewController::class, 'store'])->name('parques.store');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
