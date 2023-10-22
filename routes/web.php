<?php

use App\Livewire\Dashboard;
use App\Livewire\Categories;
use App\Livewire\CategoriesEdit;
use App\Livewire\Auth\ChangePassword;
use App\Livewire\CategoriesCreate;
use App\Livewire\CategoriesDelete;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
})->name('root');

// Authenticated Users
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('dashboard', Dashboard::class)
        ->name('dashboard');


    // Manage Categories
    Route::middleware('can:manage categories')->group(function () {
        // All Categories
        Route::get('categories', Categories::class)
            ->name('categories');

        // Add Categories
        Route::get('categories/add', CategoriesCreate::class)
            ->name('categories.create');

        // Edit Categories
        Route::get('categories/edit', CategoriesEdit::class)
            ->name('categories.edit');

        // Delete Categories
        Route::get('categories/delete', CategoriesDelete::class)
            ->name('categories.delete');
    });


    // Change Password
    Route::get('change-password', ChangePassword::class)
        ->name('change-password');
});


// includes the auth.php in routes
require __DIR__ . '/auth.php';
