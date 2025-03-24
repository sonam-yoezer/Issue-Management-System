<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast; // Add this line
use App\Http\Controllers\IssueController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisteredUserController;

// Add broadcasting routes
Broadcast::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home'); // Route for home

Route::put('/issues/{id}/update', [IssueController::class, 'update'])->name('update.issue'); // Route to update issue priority
Route::put('/issues/{id}/assign', [IssueController::class, 'assignUser'])->name('assign.user'); // Route to assign user to an issue

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.dashboard');

Route::get('user/dashboard', [UserController::class, 'index'])->middleware(['auth', 'user'])->name('user.dashboard');
Route::post('/form', function () {
    return view('user.form');
});

Route::post('/submit-issue', [IssueController::class, 'submit'])->name('submit.issue');
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/users', [RegisteredUserController::class, 'registeredUsers'])->name('admin.user');
    Route::get('/users/{id}/edit', [RegisteredUserController::class, 'edit'])->name('edit.user');  // Add this line
    Route::put('/users/{id}', [RegisteredUserController::class, 'update'])->name('update.user');  // For updating user
    Route::delete('/users/{id}', [RegisteredUserController::class, 'destroy'])->name('delete.user'); // Add this line
});
