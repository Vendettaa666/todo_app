<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
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
// Jika pakai Breeze, biarkan route auth tetap ada
require __DIR__.'/auth.php';
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dasahboard');
    }
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/tasks.index', function () {
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

    Route::view('/categories', 'categories.index')->name('categories');

    Route::post('/logout', function () {
        \Illuminate\Support\Facades\Auth::guard('web')->logout();
        \Illuminate\Support\Facades\Session::invalidate();
        \Illuminate\Support\Facades\Session::regenerateToken();
        return redirect('/');
    })->name('logout');
});


// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');

// duplicate require removed above
