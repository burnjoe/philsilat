<?php

use App\Livewire\Dashboard;
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

Route::get('/', function() {
    return redirect()->route('login');
})->name('root');

// Authenticated Users
Route::middleware('auth')->group(function () {
    Route::get('dashboard', Dashboard::class)
        ->name('dashboard');

    
    
});


// includes the auth.php in routes
require __DIR__.'/auth.php';