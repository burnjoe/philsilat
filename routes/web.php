<?php

use App\Livewire\Events;
use App\Livewire\Accounts;
use App\Livewire\DropTeam;
use App\Livewire\ViewTeam;
use App\Livewire\Dashboard;
use App\Livewire\Categories;
use App\Livewire\EventsShow;
use App\Livewire\EventsTeams;
use App\Livewire\GamesCreate;
use App\Livewire\GamesDelete;
use App\Livewire\AccountsEdit;
use App\Livewire\EventsCancel;
use App\Livewire\EventsCreate;
use App\Livewire\EventsDelete;
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
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Livewire\EventsDetails;
use App\Livewire\EventsJoin;
use App\Livewire\EventsLeave;
use App\Livewire\EventsMyTeam;
use App\Livewire\Profile;

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
    // Profile
    Route::get('profile', Profile::class)
        ->name('profile');

    // Dashboard
    Route::get('dashboard', Dashboard::class)
        ->name('dashboard');

    // All Events
    Route::get('events', Events::class)
        ->middleware('event.status-change')
        ->name('events');

    // Event Games
    Route::get('events/{event}/games', EventsShow::class)
        ->middleware(['coach.joined', 'event.status-change'])
        ->name('events.show');

    // View Team
    Route::get('events/{event}/teams/{team}/view', ViewTeam::class)
        ->middleware('event.status-change')
        ->name('events.view-team');

    // Game Matches
    Route::get('events/{event}/games/{game}/matches', GamesMatches::class)
        ->middleware('event.status-change')
        ->name('games.matches');

    // Change Password
    Route::get('change-password', ChangePassword::class)
        ->name('change-password');


    // Participate Event
    Route::middleware(['can:participate events', 'event.status-change'])->group(function () {
        // Event Details
        Route::get('events/{event}/details', EventsDetails::class)
            ->name('events.details');

        // Event Games
        Route::get('events/{event}/join', EventsJoin::class)
            ->middleware('event.registration-open')
            ->name('events.join');

        // My Team
        Route::get('events/{event}/my-team', EventsMyTeam::class)
            ->name('events.my-team');

        // Drop Selected Team
        Route::get('events/{event}/leave', EventsLeave::class)
            ->middleware('event.registration-open')
            ->name('events.leave');
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
    Route::middleware(['can:manage events', 'event.status-change'])->group(function () {
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

        // Event Results
        Route::get('{event}/event-results-pdf', [PdfController::class, 'export_event_results_pdf'])
            ->name('export_event_results_pdf');

        // Game Results
        Route::get('{event}/{game}/game-results-pdf', [PdfController::class, 'export_game_results_pdf'])
            ->name('export_game_results_pdf');
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
});


// includes the auth.php in routes
require __DIR__ . '/auth.php';
