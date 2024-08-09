<?php

use Illuminate\Support\Facades\Route;
use App\Models\job;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;

Route::get('test', function(){
    \Illuminate\Support\Facades\Mail::to('user@test.com')->send(
        new \App\Mail\JobPosted()
    );

    return 'Done';
});

Route::view('/', 'home');

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create'])->middleware('auth');
Route::get('/jobs/{job}', [JobController::class, 'show']);
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->middleware(['auth', 'can:edit,job']);
Route::patch('/jobs/{job}', [JobController::class, 'update']);
Route::delete('/jobs/{job}', [JobController::class, 'destroy']);

// Auth

Route::get('/register', [RegisteredUserController::class, 'register']);
Route::get('/login', [SessionController::class, 'login'])->name('login');
Route::post('/insert', [RegisteredUserController::class, 'store']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);





















Route::view('/contact', 'contact');