<?php

use App\Livewire\StickyWall;
use App\Livewire\CategoryManager;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

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

// Route untuk debugging Railway
Route::get('/railway-debug', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'Application is running',
        'timestamp' => now()->toISOString(),
        'environment' => app()->environment(),
        'debug_mode' => config('app.debug'),
        'url' => config('app.url'),
    ]);
});

// Health check endpoint untuk Railway
Route::get('/ping', function () {
    try {
        // Test database connection
        DB::connection()->getPdo();

        return response()->json([
            'status' => 'ok',
            'message' => 'Application is healthy',
            'timestamp' => now()->toISOString(),
            'database' => 'connected'
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Database connection failed',
            'error' => $e->getMessage(),
            'timestamp' => now()->toISOString()
        ], 503);
    }
});

// Health check sederhana tanpa database
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'Application is running',
        'timestamp' => now()->toISOString()
    ], 200);
});

// Test database connection
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "Database connection: OK";
    } catch (\Exception $e) {
        return "Database connection: FAILED - " . $e->getMessage();
    }
});

// Test environment variables
Route::get('/test-env', function () {
    return [
        'APP_ENV' => env('APP_ENV'),
        'APP_DEBUG' => env('APP_DEBUG'),
        'DB_CONNECTION' => env('DB_CONNECTION'),
        'DB_HOST' => env('DB_HOST'),
        'DB_PORT' => env('DB_PORT'),
        'DB_DATABASE' => env('DB_DATABASE'),
        'APP_URL' => env('APP_URL'),
    ];
});

// Jika pakai Breeze, biarkan route auth tetap ada
require __DIR__.'/auth.php';

// Route utama
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Perbaikan route tasks
    Route::get('/tasks', function () {
        return view('tasks.index');
    })->name('tasks.index');

    Route::view('/tasks/create', 'tasks.create')->name('tasks.create');

    Route::get('/tasks/{task}', function (Task $task) {
        abort_unless($task->user_id === auth()->id(), 403);
        return view('tasks.show', compact('task'));
    })->name('tasks.show');

    Route::get('/tasks/{task}/edit', function (Task $task) {
        abort_unless($task->user_id === auth()->id(), 403);
        return view('tasks.edit', compact('task'));
    })->name('tasks.edit');

    Route::get('/categories', CategoryManager::class)->name('categories');

    Route::get('/stickywall', StickyWall::class)->name('stickywall.index');

    Route::view('profile', 'profile')->name('profile');

    Route::post('/logout', function () {
        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});
