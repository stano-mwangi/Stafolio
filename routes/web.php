<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/agent', function () {
    return view('agent');
})->name('agent');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/ask-agent',[AgentController::class,'ask']);
Route::view('/projects','projects')->name('projects');
Route::view('/about','about')->name('about');
Route::view('/contact','contact')->name('contact');
Route::post('/contact/send',[App\Http\Controllers\ContactController::class,'send'])->name('contact.send');


require __DIR__.'/auth.php';
