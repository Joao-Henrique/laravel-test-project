<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShoppingListController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/shopping-list', [ShoppingListController::class, 'index'])->name('shopping-list.index');
    Route::post('/shopping-list', [ShoppingListController::class, 'store'])->name('shopping-list.store');
    Route::put('/shopping-list/{id}', [ShoppingListController::class, 'update'])->name('shopping-list.update');
    Route::delete('/shopping-list/{id}', [ShoppingListController::class, 'destroy'])->name('shopping-list.destroy');
});

require __DIR__.'/auth.php';
