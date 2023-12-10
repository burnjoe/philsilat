<?php

use App\Livewire\Events;
use App\Livewire\Accounts;
use App\Livewire\DropTeam;
use App\Livewire\Dashboard;
use App\Livewire\Categories;
use App\Livewire\EventsShow;
use App\Livewire\EventsTeams;
use App\Livewire\GamesCreate;
use App\Livewire\GamesDelete;
use App\Livewire\AccountsEdit;
use App\Livewire\EventsCreate;
use App\Livewire\GamesMatches;
use App\Livewire\AccountsIndex;
use App\Livewire\GamesAthletes;
use App\Livewire\GamesSettings;
use App\Livewire\AccountsDelete;
use App\Livewire\CategoriesEdit;
use App\Livewire\EventsSettings;
use App\Livewire\CategoriesCreate;
use App\Livewire\CategoriesDelete;
use App\Livewire\Auth\ChangePassword;
use App\Livewire\EventsCancel;
use App\Livewire\EventsDelete;
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

    // All Events
    Route::get('events', Events::class)
        ->name('events');

    // Event Games
    Route::get('events/{event}/games', EventsShow::class)
        ->name('events.show');

    // Game Matches
    Route::get('events/{event}/games/{game}/matches', GamesMatches::class)
        ->name('games.matches');

    // Participate Event
    Route::middleware('can:participate events')->group(function () {
        // routes
    });

    // Manage Categories
    Route::middleware('can:manage categories')->group(function () {
        // All Categories
        Route::get('categories', Categories::class)
            ->name('categories');

        // Add Categories
        Route::get('categories/add', CategoriesCreate::class)
            ->name('categories.create');

        // Edit Categories
        Route::get('categories/{category}/edit', CategoriesEdit::class)
            ->name('categories.edit');

        // Delete Categories
        Route::get('categories/{category}/delete', CategoriesDelete::class)
            ->name('categories.delete');
    });


    // Manage Events
    Route::middleware('can:manage events')->group(function () {
        // Add Events
        Route::get('events/add', EventsCreate::class)
            ->name('events.create');

        // Event Teams
        Route::get('events/{event}/teams', EventsTeams::class)
            ->name('events.teams');

        // Event Settings
        Route::get('events/{event}/settings', EventsSettings::class)
            ->name('events.settings');

        // Delete Events
        Route::get('events/{event}/delete', EventsDelete::class)
            ->name('events.delete');

        // Cancel Events
        Route::get('events/{event}/cancel', EventsCancel::class)
            ->name('events.cancel');

        // Drop Selected Team
        Route::get('events/{event}/teams/{team}/drop', DropTeam::class)
            ->middleware('event.registration-open')
            ->name('events.drop-team');

        // Drop All Teams
        Route::get('events/{event}/teams/drop', DropTeam::class)
            ->middleware('event.registration-open')
            ->name('events.drop-all-teams');

        // Game Athletes
        Route::get('events/{event}/games/{game}/athletes', GamesAthletes::class)
            ->name('games.athletes');

        // Game Settings
        Route::get('events/{event}/games/{game}/settings', GamesSettings::class)
            ->name('games.settings');

        // Delete Games
        Route::get('events/{event}/games/{game}/delete', GamesDelete::class)
            ->name('games.delete');

        // Add Games
        Route::get('events/{event}/games/add', GamesCreate::class)
            ->middleware('event.upcoming')
            ->name('games.create');
    });


    // Manage Accounts and Manage Codes
    Route::middleware(['can:manage accounts', 'can:manage codes'])->group(function () {
        // All Accounts
        Route::get('accounts', Accounts::class)
            ->name('accounts');

        // Signup Codes
        Route::get('accounts/signup-codes', AccountsIndex::class)
            ->name('accounts.index');

        // Edit Accounts
        Route::get('accounts/{user}/edit', AccountsEdit::class)
            ->name('accounts.edit');

        // Delete Accounts
        Route::get('accounts/{user}/delete', AccountsDelete::class)
            ->name('accounts.delete');
    });


    // Change Password
    Route::get('change-password', ChangePassword::class)
        ->name('change-password');
});


// includes the auth.php in routes
require __DIR__ . '/auth.php';
